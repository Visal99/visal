<?php

namespace App\Http\Controllers\User;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\PublicWork\PublicWork as Model;
use App\Model\Project\Project as Project;
use App\Model\DocumentCategory\DocumentCategory as DocumentCategory;
use App\Model\DocumentType\DocumentType as DocumentType;
use App\Model\DocumentTag\DocumentTag as DocumentTag;
use App\Model\Document\Document as Document;
use App\Model\Tag\Tag as Tag;

class PublicWorkController extends Controller
{
    public function listData(){
        
        $data =Model::get();
        if(!empty($data)){

            return view('user.public_work.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
       
        return view('user.public_work.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
                    //'slug'      =>   GenerateSlug::generateSlug('public_works', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:50',
						    'kh_title' => 'required|min:4|max:50',
                            'en_content' => 'required',
                            'kh_content' => 'required',
                            
						], 

                        [
                        ])->validate();
        
       
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.public-work.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.public_work.editForm', ['data'=>$data]);
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
						    'en_content' => 'required',
                            'kh_content' => 'required',
                            
						],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'en_content' =>  $request->input('en_content'), 
                    'kh_content' =>  $request->input('kh_content'),
                    //'slug'      =>   GenerateSlug::generateSlug('public_works', $request->input('en_title'), $id)
                    
                );
        
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

    //==============================================================Project
    public function listDataProject($public_work_id=0){
        
        $data = Model::find($public_work_id);
        $projects = Project::where('public_work_id',$public_work_id)->get();
        if(!empty($data)){

            return view('user.public_work.listProject', ['data'=>$data,'projects'=>$projects]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

     public function showCreateFormProject($public_work_id=0){
        $data = Model::find($public_work_id);
        return view('user.public_work.createFormProject',['data'=>$data]);
    }

    public function storeProject(Request $request, $public_work_id=0) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_background' =>  $request->input('en_background'), 
                    'kh_background' =>  $request->input('kh_background'),
                    'en_construction_type' =>  $request->input('en_construction_type'), 
                    'kh_construction_type' =>  $request->input('kh_construction_type'),
                    'en_category' =>  $request->input('en_category'), 
                    'kh_category' =>  $request->input('kh_category'),
                    'public_work_id' =>  $public_work_id,
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
        $id=Project::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.public-work.edit-project',['id'=>$id,'public_work_id'=>$public_work_id]));
    }

     public function showEditFormProject($public_work_id = 0, $id = 0){
        $data = Model::find($public_work_id);
        $project = Project::where('public_work_id',$public_work_id)->find($id);
        if(!empty($data)){
            return view('user.public_work.editFormProject', ['data'=>$data,'project'=>$project]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

     public function updateProject(Request $request, $public_work_id=0){
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
                    'public_work_id' =>  $public_work_id,
                    //'slug'      =>   GenerateSlug::generateSlug('projects', $request->input('en_title'), $id),
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
                    'public_work_id' =>  $public_work_id,
                    'en_period' =>  $request->input('en_period'), 
                    'kh_period' =>  $request->input('kh_period'),
                    'en_note' =>  $request->input('en_note'), 
                    'kh_note' =>  $request->input('kh_note')
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
        
        Project::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

     

     public function destroyProject($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        Project::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }

    public function listDataDocument($public_work_id=0,$slug=''){
        
        $data = Model::find($public_work_id);
       
        $documents = DB::table('documents as d')->select('d.slug','d.id','d.published','d.en_title', 'tp.en_title as type', 'pdf', 'd.updated_at')
                        ->join('document_types as tp', 'tp.id', 'd.type_id')
                        ->join('document_tag as d_t', 'd_t.document_id', 'd.id')
                        ->join('tags as t', 't.id', 'd_t.tag_id')
                        ->where('t.slug', $slug)->get();
        return view('user.public_work.listDocument', ['data'=>$data,'documents'=>$documents]);
        // if(!empty($data)){

        //     return view('user.public_work.listDocument', ['data'=>$data,'documents'=>$documents]);
        // }else{
        //     return response(view('errors.404'), 404);
        // }
    }
    public function showCreateFormDocument($public_work_id=0){
        $data = Model::find($public_work_id);
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        return view('user.public_work.createFormDocument',['data'=>$data,'categories'=>$categories,'types'=>$types]);
    }
    public function storeDocument(Request $request, $public_work_id=0) {
         $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'category_id' =>  $request->input('category'),
                    'created_at' =>  date("Y-m-d H:i:s"),
                    'type_id' =>  $request->input('type'), 
                    'slug'      =>   GenerateSlug::generateSlug('documents', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:111',
                            'kh_title' => 'required|min:4|max:111',
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
        $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/document/');
        if($pdf != ""){
            $data['pdf'] = $pdf; 
        }else{
            $data['pdf'] = "public/user/img/avatar.png" ;
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/document/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $id=Document::insertGetId($data);
        
        $slug =Model::find($public_work_id)->slug;
        $tag_id =Tag::where('slug',$slug)->first()->id;
        

        //$tags = $request->input('tag');
       
        DocumentTag::insert(['document_id' => $id, 'tag_id' => $tag_id]);
        
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.public-work.edit-document',['id'=>$id,'public_work_id'=>$public_work_id]));
    }


    public function showEditFormDocument($public_work_id = 0, $id = 0){
        //print_r($slug);die;
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        $slug = Model::find($public_work_id)->slug;
        $data = Model::find($public_work_id);
        $document = Document::find($id);
        if(!empty($data)){
            return view('user.public_work.editFormDocument', ['data'=>$data,'document'=>$document,'categories'=>$categories,'types'=>$types]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function updateDocument(Request $request){
        $id = $request->input('id');
         Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:111',
                            'kh_title' => 'required|min:4|max:111',
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
                    'category_id' =>  $request->input('category'),
                    'type_id' =>  $request->input('type'), 
                    'slug'      =>   GenerateSlug::generateSlug('documents', $request->input('en_title'),$id)
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/document/');
        if($pdf != ""){
            $data['pdf'] = $pdf; 
        }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/document/');
        if($image != ""){
            $data['image'] = $image; 
        }
        Document::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }
     public function destroyDocument($id=0){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        DocumentTag::where('document_id',$id)->delete();
        Document::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
}
