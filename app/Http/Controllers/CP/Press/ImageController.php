<?php

namespace App\Http\Controllers\CP\Press;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\News\Main as Model;
use App\Model\News\Image;

use Image as ImageUpload;

class ImageController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.press.image";
    }
    public function index($id = 0){
        $data = Model::find($id)->images();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_title', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        $data= $data->orderBy('data_order', 'ASC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends]);
    }

    function order(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            Image::where('id', $row->id)->update(['data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }

    public function create($id = 0){
        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id]);
    }

    public function store(Request $request) {
        $news_id = $request->input('news_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $news_image = Model::find($news_id)->images;
        if($news_image){
            $feature = 1;
        }else{
            $feature = 0;
        }

        $data       = array(
                    'news_id' =>  $news_id,
                    'en_title'   =>   $request->input('en_title'), 
                    'kh_title'   =>   $request->input('kh_title'), 
                    'is_featured'   =>   $feature, 
                    'creator_id'    =>  $user_id,
                    'created_at'    =>  $now, 
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                            ],
                        ],
                        [
                            'image.required' => 'Please input your image',
                        ])->validate();
        
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            ImageUpload::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/press/image/'.$imagename));
            $data['img_url']='public/uploads/press/image/'.$imagename;
        }
       
        $id  =  Image::insertGetId($data);

        Session::flash('msg', 'Data has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$news_id, 'image_id'=>$id]));
    }

    function edit($id, $image_id){
        $data = Model::find($id)->images()->find($image_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'image_id'=>$image_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $news_id = $request->input('news_id');
        $image_id = $request->input('image_id');
        $data       = array(
                    'news_id' =>  $news_id,
                    'en_title'   =>   $request->input('en_title'), 
                    'kh_title'   =>   $request->input('kh_title'), 
                    'updater_id' =>  $user_id,
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                            ],
                        ],
                        [
                            'image.required' => 'Please input your image',
                        ])->validate();

        
       if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            ImageUpload::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/press/image/'.$imagename));
            $data['img_url']='public/uploads/press/image/'.$imagename;
        }
        Model::find($news_id)->images()->where('id', $image_id)->update($data);
       
        Session::flash('msg', 'Data has been Updated!');
        return redirect(route($this->route.'.edit', ['id'=>$news_id, 'image_id'=>$image_id]));
    }
    
    public function trash($image_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Image::find($image_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Data has been deleted'
        ]);
    }
    function updateFeatured(Request $request){

      $news_id   = $request->input('news_id');  
      $id   = $request->input('id');
      $data = array('is_featured' => $request->input('active'));
      $data_show = array('is_featured' => 0);
      Model::find($news_id)->images()->update($data_show);
      Model::find($news_id)->images()->where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Feature status has been updated.'
      ]);
    }

 

}
