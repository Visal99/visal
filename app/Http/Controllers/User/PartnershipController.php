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

use App\Model\Partnership\Partnership as Model;


class PartnershipController extends Controller
{
    
    function __construct (){
       
    }

   
    public function listData(){
        $data = Model::get();
        if(!empty($data)){
            return view('user.partnership.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
     public function showCreateForm(){
        return view('user.partnership.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                     'website' =>  $request->input('website'),
                    'en_description' =>  $request->input('en_description'),
                    'kh_description' =>  $request->input('kh_description')
                );
        Session::flash('invalidData', $data );
        Validator::make(
                      $request->all(), 
                [
                'en_title' => 'required|min:4|max:50',
                'kh_title' => 'required|min:4|max:50',
                'website' => 'required',
                'en_description' => 'required',
                'kh_description' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(100)->minHeight(100)->maxWidth(500)->maxHeight(500),
                            ],
            ], 

                        [
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();
        
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/partnership/');
        if($image != ""){
            $data['logo'] = $image; 
        }else{
            $data['logo'] = "public/user/img/avatar.png" ;
        }
    $id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
    return redirect(route('user.partnership.edit', $id));
    }


    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.partnership.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                $request->all(), 
                [
                    'en_title' => 'required|min:4|max:50',
                    'kh_title' => 'required|min:4|max:50',
                    'website' => 'required',
                    'en_description' => 'required',
                    'kh_description' => 'required',
                
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(100)->minHeight(100)->maxWidth(500)->maxHeight(500),
                            ],
            ],
                        [
                            
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();

    
    $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'website' =>  $request->input('website'),
                    'en_description' =>  $request->input('en_description'),
                    'kh_description' =>  $request->input('kh_description')
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/partnership/');
        if($image != ""){
            $data['logo'] = $image; 
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
