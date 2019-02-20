<?php

namespace App\Http\Controllers\CP\Contact;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Contact\Main as Model;
use App\Model\Contact\Message;

use Image as ImageUpload;

class MessageController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.contact.message";
    }
    public function index($id = 0){
        $data = Model::find($id)->messages();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_title', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
         $children = Model::where('parent_id', $id)->where('id', '<>', $id)->get(); 
        $contact = Model::find($id);
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends, 'children'=>$children, 'contact'=>$contact]);
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
        $contact_id = $request->input('contact_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'contact_id' =>  $contact_id,
                    'en_title'   =>   $request->input('en_title'), 
                    'kh_title'   =>   $request->input('kh_title'), 
                    'creator_id'    =>  $user_id,
                    'created_at'    =>  $now, 
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required',
                            'kh_title' => 'required',
                        ],
                        [])->validate();
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            ImageUpload::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/press/image/'.$imagename));
            $data['img_url']=$imagename;
        }
       
        $id  =  Image::insertGetId($data);

        Session::flash('msg', 'Data has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$contact_id, 'message_id'=>$id]));
    }

    function edit($id, $message_id){
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = Model::find($id)->messages()->find($message_id);
        $dataupdate       = array(
                    'is_seen' => 1,
                    'seener_id' =>  $user_id,
                    'seen_at' =>  $now
                );
        Model::find($id)->messages()->where('id', $message_id)->update($dataupdate);

        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'message_id'=>$message_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $contact_id = $request->input('contact_id');
        $message_id = $request->input('message_id');
        $data       = array(
                    'contact_id' =>  $contact_id,
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
                           'en_title' => 'required',
                            'kh_title' => 'required',
                            
                        ],
                        [
                        ])->validate();

        
       if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            ImageUpload::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/press/image/'.$imagename));
            $data['img_url']=$imagename;
        }
        Model::find($contact_id)->messages()->where('id', $message_id)->update($data);
       
        Session::flash('msg', 'Data has been Updated!');
        return redirect(route($this->route.'.edit', ['id'=>$contact_id, 'message_id'=>$message_id]));
    }
    
    public function trash($message_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Image::find($message_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Data has been deleted'
        ]);
    }


 

}
