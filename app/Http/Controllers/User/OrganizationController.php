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

use App\Model\Organization\Organization as Model;


class OrganizationController extends Controller
{
    
    function __construct (){
       
    }

   
    public function listData(){
        $data = Model::get();
        if(!empty($data)){
            return view('user.organization.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
     public function showCreateForm(){
        return view('user.organization.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'name' =>   $request->input('name'), 
                    'link' =>  $request->input('link')
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                      $request->all(), 
                [
                'en_link' => 'required',
                'kh_link' => 'required',
                            'en_image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
                            ],
                            'kh_image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
                            ],
                ], 

                        [
                            'en_image.dimensions' => 'Please provide valide image with height between 10-5000px and width between 10-1500px.',
                            'kh_image.dimensions' => 'Please provide valide image with height between 10-5000px and width between 10-1500px.',
                        ])->validate();
        
        
        $en_image = FileUpload::uploadFile($request, 'en_image', 'uploads/organization/');
        if($en_image != ""){
            $data['en_image'] = $en_image; 
        }else{
            $data['en_image'] = "public/user/img/avatar.png" ;
        }
        $kh_image = FileUpload::uploadFile($request, 'kh_image', 'uploads/organization/');
        if($en_image != ""){
            $data['kh_image'] = $en_image; 
        }else{
            $data['kh_image'] = "public/user/img/avatar.png" ;
        }
    $id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
    return redirect(route('user.organization.edit', $id));
    }


    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.organization.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                $request->all(), 
                [
                     'en_link' => 'required',
                'kh_link' => 'required',
                
                           'en_image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
                            ],
                            'kh_image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
                            ],
                ], 

                        [
                            'en_image.dimensions' => 'Please provide valide image with height between 10-5000px and width between 10-1500px.',
                            'kh_image.dimensions' => 'Please provide valide image with height between 10-5000px and width between 10-1500px.',
                        ])->validate();

    
                $data = array(
                    'en_link' =>   $request->input('en_link'), 
                    'kh_link' =>  $request->input('kh_link')
                    
                );
       
        $en_image = FileUpload::uploadFile($request, 'en_image', 'uploads/organization/');
        if($en_image != ""){
            $data['en_image'] = $en_image; 
        }else{
            $data['en_image'] = "public/user/img/avatar.png" ;
        }

        $kh_image = FileUpload::uploadFile($request, 'kh_image', 'uploads/organization/kh/');
        if($kh_image != ""){
            $data['kh_image'] = $kh_image; 
        }else{
            $data['kh_image'] = "public/user/img/avatar.png" ;
        }
    
        Model::where('id', $id)->update($data);
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



   
    
}
