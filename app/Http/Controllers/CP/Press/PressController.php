<?php

namespace App\Http\Controllers\CP\Press;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\News\Main as Model;
use App\Model\News\Category as Category;
class PressController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.press";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
       
        $categories = Category::get();
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $category       =   isset($_GET['category'])?$_GET['category']:0;
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_title', 'like', '%'.$key.'%')->orWhere('kh_title', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }

        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
        }

        $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends,'categories'=>$categories]);
    }
    public function feature(){
       
        $categories = Category::get();
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $category       =   isset($_GET['category'])?$_GET['category']:0;
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_title', 'like', '%'.$key.'%')->orWhere('kh_title', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }

        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
        }

        $data= $data->orderBy('data_order', 'ASC')->where('is_featured',1)->limit(10)->paginate($limit);
        
        return view($this->route.'.feature', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends,'categories'=>$categories]);
    }
    public function create(){
        $categories = Category::get();
        return view($this->route.'.create' , ['route'=>$this->route,'categories'=>$categories]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'category_id' =>   $request->input('category'), 
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'), 
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'event_date' =>   $request->input('event_date'), 
                    'is_published' =>  $request->input('status'),
                    'is_featured' =>  $request->input('featured'),
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                           'category' => 'required|exists:news_category,id',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            
                        ],
                        [
                            'category.required' => 'Please Select category',
                            'category.exists' => 'Please Select category',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();


		$id=Model::insertGetId($data);

        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $categories = Category::get();
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'categories'=>$categories]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'category_id' =>   $request->input('category'), 
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'event_date' =>   $request->input('event_date'),
                    'is_published' =>  $request->input('status'),
                    'is_featured' =>  $request->input('featured'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

         Validator::make(
                        $request->all(), 
                        [
                           'category' => 'required|exists:news_category,id',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                           
                        ],
                        [
                            'category.required' => 'Please Select category',
                            'category_id.exists' => 'Please Select category',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();
        // if($request->input('status')=="")
        // {
        //     $data['is_published']=0;
        // }else{
        //     $data['is_published']=1;
        //     $data['published_at']=$now;
        // }
        // if($request->input('feature')=="")
        // {
        //     $data['is_featured']=0;
        // }else{
        //     $data['is_featured']=1;
        //     $data['featured_updated_at']=$now;
        // }
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}
    function order(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            Model::where('id', $row->id)->update(['data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }
    public function trash($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Data has been deleted'
        ]);
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Published status has been updated.'
      ]);
    }
    function updateFeatured(Request $request){
      $id   = $request->input('id');
      $data = array('is_featured' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Feature status has been updated.'
      ]);
    }
}
