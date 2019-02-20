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

use App\Model\AutomationManual\AutomationManual as Model;
use App\Model\AutomationSystem\AutomationSystem as AutomationSystem;

class AutomationManualController extends Controller
{
    public function listData(){
        
        $name          = isset($_GET['name'])?$_GET['name']:"";
        $automation_system       =isset($_GET['automation_system']) ? $_GET['automation_system'] : 0;
        $limit          = isset($_GET['limit'])?$_GET['limit']:10;
        if(!is_numeric($limit)){ $limit = 10;}

         $data = Model::with('automation_system')->orderBy('id', 'DESC');
        if($name != ""){
            $data = $data->where('en_title', $name );
        }
        if($automation_system != ""){
            $data = $data->where('automation_system_id', $automation_system );
        }
        
        $data = $data->paginate($limit);
        $automation_systems = AutomationSystem::get();
        if(!empty($data)){

            return view('user.automation_manual.list', ['data'=>$data, 'automation_systems'=>$automation_systems]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
         $automation_systems = AutomationSystem::get();
        //print_r($categories);die;
        return view('user.automation_manual.createForm', ['automation_systems'=>$automation_systems]);
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'automation_system_id' =>  $request->input('automation_system')
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:100',
						    'kh_title' => 'required|min:4|max:100',
                            'pdf' => [
                                            'required',
                                            'mimes:pdf',
                                            
                            ],
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						], 

                        [
                           
                        ])->validate();
        
       if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/automation_manual/');
        if($pdf != ""){
            $data['pdf'] = $pdf; 
        }else{
            $data['pdf'] = "public/user/img/avatar.png" ;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/automation_manual/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.automation-manual.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
       $automation_systems = AutomationSystem::get();
        if(!empty($data)){
            return view('user.automation_manual.editForm', ['data'=>$data,'automation_systems'=>$automation_systems]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
        				$request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:100',
                            'kh_title' => 'required|min:4|max:100',
                            'pdf' => [
                                            'sometimes',
                                            'required',
                                            'mimes:pdf',
                            ],
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'automation_system_id' =>  $request->input('automation_system')
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/automation_manual/');
        if($pdf != ""){
            $data['pdf'] = $pdf; 
        }
		$image = FileUpload::uploadFile($request, 'image', 'uploads/automation_manual/');
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
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        Model::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
}
