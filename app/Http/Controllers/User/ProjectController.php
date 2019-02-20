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

use App\Model\Project\Project as Model;
use App\Model\PublicWork\PublicWork as PublicWork;

class ProjectController extends Controller
{
    public function listData(){
        
        $name          = isset($_GET['name'])?$_GET['name']:"";
        $public_work       =isset($_GET['public_work']) ? $_GET['public_work'] : 0;
        $limit          = isset($_GET['limit'])?$_GET['limit']:10;
        if(!is_numeric($limit)){ $limit = 10;}

         $data = Model::with('public_work')->orderBy('id', 'DESC');
        if($name != ""){
            $data = $data->where('en_title', $name );
        }
        if($public_work != ""){
            $data = $data->where('public_work_id', $public_work );
        }
        $data = $data->paginate($limit);
        $public_works = PublicWork::get();
        if(!empty($data)){

            return view('user.project.list', ['data'=>$data, 'public_works'=>$public_works]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        $public_works = PublicWork::get();
        //print_r($categories);die;
        return view('user.project.createForm', ['public_works'=>$public_works]);
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_background' =>  $request->input('en_background'), 
                    'kh_background' =>  $request->input('kh_background'),
                    'en_construction_type' =>  $request->input('en_construction_type'), 
                    'kh_construction_type' =>  $request->input('kh_construction_type'),
                    'en_category' =>  $request->input('en_category'), 
                    'kh_category' =>  $request->input('kh_category'),
                    'public_work_id' =>  $request->input('public_work'),
                    'slug'      =>   GenerateSlug::generateSlug('projects', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:50',
						    'kh_title' => 'required|min:4|max:50',
                            'en_background' => 'required',
                            'kh_background' => 'required',
                            'en_construction_type' => 'required',
                            'kh_construction_type' => 'required',
                            'en_category' => 'required',
                            'kh_category' => 'required',
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
        $image = FileUpload::uploadFile($request, 'image', 'uploads/project/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.project.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        $public_works = PublicWork::get();
        if(!empty($data)){
            return view('user.project.editForm', ['data'=>$data,'public_works'=>$public_works]);
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
                            'en_background' => 'required',
                            'kh_background' => 'required',
                            'en_construction_type' => 'required',
                            'kh_construction_type' => 'required',
                            'en_category' => 'required',
                            'kh_category' => 'required',
                            'image' => [
                                            'sometime',
                                            
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
                    'en_background' =>  $request->input('en_background'), 
                    'kh_background' =>  $request->input('kh_background'),
                    'en_construction_type' =>  $request->input('en_construction_type'), 
                    'kh_construction_type' =>  $request->input('kh_construction_type'),
                    'en_category' =>  $request->input('en_category'), 
                    'kh_category' =>  $request->input('kh_category'),
                    'public_work_id' =>  $request->input('public_work'),
                    'slug'      =>   GenerateSlug::generateSlug('projects', $request->input('en_title'), $id)
                    
                );
        if($request->input('feature')=="")
        {
            $data['featured']=0;
        }else{
            $data['featured']=1;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/project/');
        if($image != ""){
            $data['image'] = $image; 
        }
		
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

     public function updateLocation(Request $request){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'en_province' => 'required|min:4|max:50',
                            'kh_province' => 'required|min:4|max:50',
                            'en_location' => 'required',
                            'kh_location' => 'required',
                            'en_consultant' => 'required',
                            'kh_consultant' => 'required',
                            'en_authority' => 'required',
                            'kh_authority' => 'required',
                            'en_constructor' => 'required',
                            'kh_constructor' => 'required',
                           
                        ],
                        [
                            
                        ])->validate();

        
        $data = array(
                    'en_province' =>   $request->input('en_province'), 
                    'kh_province' =>  $request->input('kh_province'), 
                    'en_location' =>  $request->input('en_location'), 
                    'kh_location' =>  $request->input('kh_location'),
                    'en_consultant' =>  $request->input('en_consultant'), 
                    'kh_consultant' =>  $request->input('kh_consultant'),
                    'en_authority' =>  $request->input('en_authority'), 
                    'kh_authority' =>  $request->input('kh_authority'),
                    'en_constructor' =>  $request->input('en_constructor'), 
                    'kh_constructor' =>  $request->input('kh_constructor'),
                    'en_period' =>  $request->input('en_period'), 
                    'kh_period' =>  $request->input('kh_period'),
                    'en_note' =>  $request->input('en_note'), 
                    'kh_note' =>  $request->input('kh_note'),
                );
        
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }
    public function showEditLocationForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.project.editLocation', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
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
