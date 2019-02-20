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

use App\Model\Press\Press as Model;
use App\Model\PressCategory\PressCategory as PressCategory;

class PressesController extends Controller
{
    public function listData(){
        
        $name          = isset($_GET['name'])?$_GET['name']:"";
        $category       =isset($_GET['category']) ? $_GET['category'] : 0;
        $limit          = isset($_GET['limit'])?$_GET['limit']:10;
        if(!is_numeric($limit)){ $limit = 10;}

         $data = Model::with('category')->orderBy('id', 'DESC');
        if($name != ""){
            $data = $data->where('en_title', $name );
        }
        if($category != ""){
            $data = $data->where('category_id', $category );
        }
        $data = $data->paginate($limit);
        $categories = PressCategory::get();
        if(!empty($data)){

            return view('user.presses.list', ['data'=>$data, 'categories'=>$categories]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        $categories = PressCategory::get();
        //print_r($categories);die;
        return view('user.presses.createForm', ['categories'=>$categories]);
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'category_id' =>  $request->input('category'),
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
					'updated_at' =>  date("Y-m-d H:i:s"),
                    'slug'      =>   GenerateSlug::generateSlug('presses', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required',
						    'kh_title' => 'required',
                            'en_description' => 'required',
                            'kh_description' => 'required',
                            'en_content' => 'required',
                            'kh_content' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						], 

                        [
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();
        
        if($request->input('feature')=="")
        {
            $data['featured']=0;
        }else{
            $data['featured']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/presses/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $feature_image = FileUpload::uploadFile($request, 'feature_image', 'uploads/presses/');
        if($feature_image != ""){
            $data['feature_image'] = $feature_image; 
        }else{
            $data['feature_image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.presses.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        $categories = PressCategory::get();
        if(!empty($data)){
            return view('user.presses.editForm', ['data'=>$data,'categories'=>$categories]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
        				$request->all(), 
			        	[
						    'en_title' => 'required',
                            'kh_title' => 'required',
						    'en_description' => 'required',
                            'kh_description' => 'required',
                            'en_content' => 'required',
                            'kh_content' => 'required',
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						],
                        [
                            
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();

		
		$data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'), 
                    'category_id' =>  $request->input('category'),
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
                    //'slug'      =>   GenerateSlug::generateSlug('presses', $request->input('en_title'),$id)
                    
                );
        if($request->input('feature')=="")
        {
            $data['featured']=0;
        }else{
            $data['featured']=1;
        }

        $image = FileUpload::uploadFile($request, 'image', 'uploads/presses/');
        if($image != ""){
            $data['image'] = $image; 
        }
		$feature_image = FileUpload::uploadFile($request, 'feature_image', 'uploads/presses/feature/');
        if($feature_image != ""){
            $data['feature_image'] = $feature_image; 
        }
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}


    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('featured' => $request->input('feature'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'User status has been updated.'
      ]);
    }
  
    public function destroy($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        Model::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
}
