<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
 use Hash;
 use Auth;
 use Session ;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;
use Illuminate\Support\Facades\DB;

use App\Model\Contact\Contact as Model;


class ContactController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "user.contact";
    }
   
    public function listData($contact = "", $department = ""){
        if($contact != ""){
            $contact = Model::select('id', 'has_departments','slug')->where('slug', $contact)->first();
            if(count($contact) == 1){
                if($contact->has_departments == 1){
                    if($department != ""){
                        $department = DB::table('contact_departments')->select('id','slug')->where('slug', $department)->first();
                        if(count($department) == 1){
                            return $this->showEditForm($contact->id, $department->id);
                        }else{
                            return $this->contact($contact->id);
                        }
                    }else{
                        return $this->contact($contact->id);
                    }
                }else{
                    $department = DB::table('contact_departments')->select('id','slug')->where('contact_id', $contact->id)->first();
                    if(count($department) == 1){
                        return $this->showEditForm($contact->id, $department->id);
                    }else{
                        return response(view('errors.404'), 404);
                    }
                }
            }else{
               return response(view('errors.404'), 404);
            }
        }else{
            return response(view('errors.404'), 404);
        }
    }

    function contact($contact_id = 0){
        $contact = Model::find($contact_id);
        $departments = DB::table('contact_departments')->where('contact_id', $contact_id)->get();
        return view($this->route.'.list',['route'=>$this->route, 'contact'=>$contact, 'departments'=>$departments]);
    }
    
    public function showCreateForm($contact_id = 0){
       
        $contact = Model::find($contact_id);
        if( count($contact) == 1 ){
           return view($this->route.'.createForm', ['route'=>$this->route, 'contact'=>$contact]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en-title'), 
                    'kh_title' =>   $request->input('kh-title'),
                    'contact_id' =>  $contact_id, 
                    'website' =>  $request->input('website'),
                    'phone' =>  $request->input('phone'),
                    'email' =>  $request->input('email'),
                    'address' =>  $request->input('address'),
                    'lat' =>  $request->input('lat'),
                    'lon' =>  $request->input('lon'),
                    'url' =>  $request->input('url'),
                    'published' =>  0,
                    'slug'      =>   GenerateSlug::generateSlug('contact_departments', $request->input('en-title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                      $request->all(), 
                [
                'en-title' => 'required|min:4|max:50',
                'kh-title' => 'required|min:4|max:50',
                'website' => '',
                'phone' => 'required',
                'email' => 'email',
                'address' => 'required',
                'lat' => 'required',
                'lon' => 'required',
                            
                ], 

            [
            ])->validate();
        
       
        $id=DB::table('contact_departments')->insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route($this->route.'.edit', ['contact_id'=>$request->input('contact_id'), 'department_id'=>$id]));
    }


    public function showEditForm($contact_id = 0, $department_id =0){
        $contact = Model::find($contact_id);
        if( count($contact) == 1 ){
            $department = DB::table('contact_departments')->where('id', $department_id)->first();
            if(!empty($department)){
                return view($this->route.'.editForm',['route'=>$this->route, 'contact'=>$contact, 'department_id'=>$department_id,  'data'=>$department]);
            }else{
                return response(view('errors.404'), 404);
            }
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        $contact_id = $request->input('contact_id');
        Validator::make(
                $request->all(), 
                [
                    'en-title' => 'required|min:4|max:50',
                    'kh-title' => 'required|min:4|max:50',
                    'website' => 'required|min:1|max:50',
                    'phone' => 'required|min:1|max:50',
                    'email' => 'email',
                    'address' => 'required|min:1|max:150',
                    'lat' => 'required|min:1|max:50',
                    'lon' => 'required|min:1|max:50',
                        
                ],
                        [
                            
                        ])->validate();

    
    $data = array(
                    'en_title' =>   $request->input('en-title'), 
                    'kh_title' =>   $request->input('kh-title'),
                    'contact_id' =>  $contact_id, 
                    'website' =>  $request->input('website'),
                    'phone' =>  $request->input('phone'),
                    'email' =>  $request->input('email'),
                    'address' =>  $request->input('address'),
                    'lat' =>  $request->input('lat'),
                    'lon' =>  $request->input('lon'),
                    'url' =>  $request->input('url'), 
                    //'slug'      =>   GenerateSlug::generateSlug('contact_departments', $request->input('en-title'))
                    
                );
        
        DB::table('contact_departments')->where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }


    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('published' => $request->input('publish'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'User status has been updated.'
      ]);
    }
  
    public function destroy($id){
        Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        Model::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }

    function message($contact_id, $department_id){
        $contact = Model::find($contact_id);
        if( count($contact) == 1 ){
            $department = DB::table('contact_departments')->where('id', $department_id)->first();
            if(!empty($department)){
                $messages = DB::table('contact_department_messages')->where('contact_department_id', $department_id)->get();
                return view($this->route.'.message', ['route'=>$this->route, 'contact'=>$contact, 'department_id'=>$department_id, 'data'=>$department, 'messages'=>$messages]);
            }else{
                return response(view('errors.404'), 404);
            }
        }else{
            return response(view('errors.404'), 404);
        }
    }



   
    
}
