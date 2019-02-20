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

use App\Model\Tag\Tag as Model;
use App\Model\Document\Document as Document;

class TagController extends Controller
{
    public function listData(){
        
        $name          = isset($_GET['name'])?$_GET['name']:"";
        $document       =isset($_GET['document']) ? $_GET['document'] : 0;
        $limit          = isset($_GET['limit'])?$_GET['limit']:10;
        if(!is_numeric($limit)){ $limit = 10;}

         $data = Model::orderBy('id', 'DESC');
        if($name != ""){
            $data = $data->where('en_title', $name );
        }
        if($document != ""){
            $data = $data->where('document_id', $document );
        }
        $data = $data->paginate($limit);
        $documents = Document::get();
        if(!empty($data)){

            return view('user.tag.list', ['data'=>$data, 'documents'=>$documents]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        $documents = Document::get();
        //print_r($categories);die;
        return view('user.tag.createForm', ['documents'=>$documents]);
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    
                    'slug'      =>   GenerateSlug::generateSlug($request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:50',
						    'kh_title' => 'required|min:4|max:50',
                           
						], 

                        [
                           
                        ])->validate();
        
       
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.tag.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        $documents = Document::get();
        if(!empty($data)){
            return view('user.tag.editForm', ['data'=>$data,'documents'=>$documents]);
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
                           
						],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'document_id' =>  $request->input('document'),
                    'slug'      =>   GenerateSlug::generateSlug($request->input('en_title'))
                    
                );
        
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
