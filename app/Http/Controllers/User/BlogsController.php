<?php

namespace App\Http\Controllers\User;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Blog\Blogs as Model;

class BlogsController extends Controller
{
    public function listData(){
        $data = Model::get();
        if(!empty($data)){
            return view('user.blog.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        return view('user.blog.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
                    'slug'      =>   GenerateSlug::generateSlug('blogs', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:1|max:500',
						    'kh_title' => 'required|min:1|max:500',
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
        $image = FileUpload::uploadFile($request, 'image', 'uploads/blog/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $feature_image = FileUpload::uploadFile($request, 'feature_image', 'uploads/blog/');
        if($image != ""){
            $data['feature_image'] = $feature_image; 
        }else{
            $data['feature_image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.blog.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.blog.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
        				$request->all(), 
			        	[
						    'en_title' => 'required|min:1|max:500',
                            'kh_title' => 'required|min:1|max:500',
						    
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
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
                    'slug'      =>   GenerateSlug::generateSlug('automation_systems', $request->input('en_title'),$id)
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/blog/');
        if($image != ""){
            $data['image'] = $image; 
        }
		$feature_image = FileUpload::uploadFile($request, 'feature_image', 'uploads/blog/');
        if($image != ""){
            $data['feature_image'] = $feature_image; 
        }else{
            $data['feature_image'] = "public/user/img/avatar.png" ;
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
