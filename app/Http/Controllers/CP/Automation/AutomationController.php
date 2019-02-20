<?php

namespace App\Http\Controllers\CP\Automation;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Automation\Main as Model;
use App\Model\GallaryDetail as Detail;
use Image;
class AutomationController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.automation";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
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
    public function create(){
        return view($this->route.'.create' , ['route'=>$this->route]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'kh_title_abbre' =>   $request->input('kh_title_abbre'), 
                    'en_title_abbre' =>  $request->input('en_title_abbre'),
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'kh_more' =>   $request->input('kh_more'), 
                    'en_more' =>  $request->input('en_more'),
                    'video' =>  $request->input('video'),
                    'appstore' =>  $request->input('appstore'),
                    'playstore' =>  $request->input('playstore'),
                    'website' =>  $request->input('website'),
                    'en_phone' =>  $request->input('en_phone'),
                    'kh_phone' =>  $request->input('kh_phone'),
                    'email' =>  $request->input('email'),
                    'kh_working_hour' =>  $request->input('kh_working_hour'),
                    'en_working_hour' =>  $request->input('en_working_hour'),
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                           'kh_title_abbre' => 'required',
                           'en_title_abbre' => 'required',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            
                        ],
                        [
                            'kh_title_abbre.required' => 'Please input title abbre in khmer',
                            'en_title_abbre.required' => 'Please input title abbre in english',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();

        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(696, 492)->save(public_path('uploads/automation/image/'.$imagename));
            $data['image_url']='public/uploads/automation/image/'.$imagename;
        }
        if($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconname = time().'.'.$icon->getClientOriginalExtension(); 
            Image::make($icon->getRealPath())->resize(130, 97)->save(public_path('uploads/automation/icon/'.$iconname));
            $data['icon']='public/uploads/automation/icon/'.$iconname;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    
                   'kh_title_abbre' =>   $request->input('kh_title_abbre'), 
                    'en_title_abbre' =>  $request->input('en_title_abbre'),
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'kh_more' =>   $request->input('kh_more'), 
                    'en_more' =>  $request->input('en_more'),
                    'video' =>  $request->input('video'),
                    'appstore' =>  $request->input('appstore'),
                    'playstore' =>  $request->input('playstore'),
                    'website' =>  $request->input('website'),
                    'en_phone' =>  $request->input('en_phone'),
                    'kh_phone' =>  $request->input('kh_phone'),
                    'email' =>  $request->input('email'),
                    'kh_working_hour' =>  $request->input('kh_working_hour'),
                    'en_working_hour' =>  $request->input('en_working_hour'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

       Validator::make(
                        $request->all(), 
                        [
                           'kh_title_abbre' => 'required',
                           'en_title_abbre' => 'required',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            
                        ],
                        [
                            'kh_title_abbre.required' => 'Please input title abbre in khmer',
                            'en_title_abbre.required' => 'Please input title abbre in english',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();
       
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(696, 492)->save(public_path('uploads/automation/image/'.$imagename));
            $data['image_url']='public/uploads/automation/image/'.$imagename;
        }
        if($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconname = time().'.'.$icon->getClientOriginalExtension(); 
            Image::make($icon->getRealPath())->resize(130, 97)->save(public_path('uploads/automation/icon/'.$iconname));
            $data['icon']='public/uploads/automation/icon/'.$iconname;
        }
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

     public function trash($id){
        Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
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
