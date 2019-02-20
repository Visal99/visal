<?php

namespace App\Http\Controllers\CP\Contact;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Contact\Main as Model;
class ContactController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.contact";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
       
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:100); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
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

        $data= $data->orderBy('data_order', 'ASC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends]);
    }
   
    public function create(){
        $parents = Model::where('parent_id', null)->get();
        return view($this->route.'.create' , ['route'=>$this->route, 'parents'=>$parents]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'), 
                    'kh_contact_person' =>   $request->input('kh_contact_person'), 
                    'en_contact_person' =>  $request->input('en_contact_person'), 
                    'kh_position' =>   $request->input('kh_position'), 
                    'en_position' =>  $request->input('en_position'), 
                    'website' =>   $request->input('website'), 
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email'), 
                    'kh_address' =>   $request->input('kh_address'), 
                    'en_address' =>  $request->input('en_address'), 
                    'lat' =>   $request->input('lat'), 
                    'lng' =>  $request->input('lng'),
                    'google_link' =>  $request->input('google_link'),
                    'is_published' =>  $request->input('status'),
                    'creator_id' => $user_id,
                    'created_at' => $now, 
                    'slug' => GenerateSlug::generateSlug('contact', $request->input('en_title'))
                );
         if($request->input('parent') != ""){
            $data['parent_id'] = $request->input('parent');
        }

        Session::flash('invalidData', $data );
       Validator::make(
                        $request->all(), 
                        [
                           'kh_title' => 'required',
                           'en_title' => 'required',
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();

      

		$id=Model::insertGetId($data);

        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        $children = Model::where('parent_id', $id)->where('id', '<>', $id)->get(); 
        
        $parents = Model::where('parent_id', null)->where('id', '<>', $id)->get();
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data, 'parents'=>$parents, 'children'=>$children]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'), 
                    'kh_contact_person' =>   $request->input('kh_contact_person'), 
                    'en_contact_person' =>  $request->input('en_contact_person'), 
                    'kh_position' =>   $request->input('kh_position'), 
                    'en_position' =>  $request->input('en_position'), 
                    'website' =>   $request->input('website'), 
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email'), 
                    'kh_address' =>   $request->input('kh_address'), 
                    'en_address' =>  $request->input('en_address'), 
                    'lat' =>   $request->input('lat'), 
                    'lng' =>  $request->input('lng'),
                    'google_link' =>  $request->input('google_link'),
                    'is_published' =>  $request->input('status'),
                    'updater_id' => $user_id,
                    'updated_at' => $now, 
                    //'slug' => GenerateSlug::generateSlug('contact', $request->input('en_title'), $id)
                );
        if($request->input('parent') != ""){
            $data['parent_id'] = $request->input('parent');
        }else{
            $data['parent_id'] = null;
        }
        

        Validator::make(
                        $request->all(), 
                        [
                           'kh_title' => 'required',
                           'en_title' => 'required',
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();
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
    
}
