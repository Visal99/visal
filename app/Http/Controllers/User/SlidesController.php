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

use App\Model\Slide\Slides as Model;


class SlidesController extends Controller
{
    
    function __construct (){
       
    }

   
    public function listData(){
        $data = Model::get();
        if(!empty($data)){
            return view('user.slide.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
     public function showCreateForm(){
        return view('user.slide.createForm');
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
                'name' => 'required|min:6|max:50',
                'link' => 'required|min:1|max:50',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
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
        $image = FileUpload::uploadFile($request, 'image', 'uploads/slide/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
    $id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
    return redirect(route('user.slide.edit', $id));
    }


    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.slide.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                $request->all(), 
                [
                    'name' => 'required|min:6|max:50',
                            'link' => 'required|min:1|max:50',
                
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1500)->maxHeight(1500),
                            ],
            ],
                        [
                            
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();

    
    $data = array(
                    'name' =>   $request->input('name'), 
                    'link' =>  $request->input('link')
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/slide/');
        if($image != ""){
            $data['image'] = $image; 
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
