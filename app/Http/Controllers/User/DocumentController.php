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
use Illuminate\Support\Facades\DB;

use App\Model\Document\Document as Model;
use App\Model\DocumentCategory\DocumentCategory as DocumentCategory;
use App\Model\DocumentType\DocumentType as DocumentType;
use App\Model\DocumentTag\DocumentTag as DocumentTag;
use App\Model\Tag\Tag as Tag;

class DocumentController extends Controller
{
    public function listData(){
        
        $name          = isset($_GET['name'])?$_GET['name']:"";
        $category       =isset($_GET['category']) ? $_GET['category'] : 0;
        $type       =isset($_GET['type']) ? $_GET['type'] : 0;
        $limit          = isset($_GET['limit'])?$_GET['limit']:10;
        if(!is_numeric($limit)){ $limit = 10;}

         $data = DB::table('documents as d')
                ->join('document_categories as c', 'c.id', '=', 'd.category_id')
                ->join('document_types as t', 't.id', '=', 'd.type_id')
                ->select('d.en_title','d.id','d.published','d.updated_at','c.en_title as category','t.en_title as type','d.pdf','d.created_at')->orderBy('d.id', 'DESC');

        if($name != ""){
            $data = $data->where('en_title', $name );
        }
        if($category != 0){
            $data = $data->where('category_id', $category );
        }
        if($type != 0){
            $data = $data->where('type_id', $type );
        }
        $data = $data->paginate($limit);
        
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        if(!empty($data)){

            return view('user.document.list', ['data'=>$data, 'categories'=>$categories,'types'=>$types]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        $tags = Tag::get();
        //print_r($categories);die;
        return view('user.document.createForm', ['categories'=>$categories,'types'=>$types,'tags'=>$tags]);
    }
    public function store(Request $request) {
        
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'category_id' =>  $request->input('category'),
                    'created_at' =>  date("Y-m-d H:i:s"),
                    'type_id' =>  $request->input('type'),
                    'google_link' =>  $request->input('google_link'),  
                    'slug'      =>   GenerateSlug::generateSlug('documents', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required',
						    'kh_title' => 'required',
                            'google_link' => 'required',
                            
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
        // $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/document/');
        // if($pdf != ""){
        //     $data['pdf'] = $pdf; 
        // }else{
        //     $data['pdf'] = "public/user/img/avatar.png" ;
        // }
        $image = FileUpload::uploadFile($request, 'image', 'uploads/document/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        $tags = $request->input('tag');
        $result = count($tags);

        for ($tags = 1; $tags <= $result; $tags++){
            DocumentTag::insert(['document_id' => $id, 'tag_id' => $tags]);
        }
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.document.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        $tags = Tag::get();
        $data_tags = DocumentTag::where('document_id',$id)->get();
        if(!empty($data)){
            return view('user.document.editForm', ['data'=>$data,'categories'=>$categories,'types'=>$types,'tags'=>$tags,'data_tags'=>$data_tags]);
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
                            'google_link' => 'required',
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
                    'google_link' =>  $request->input('google_link'),
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
        // $pdf = FileUpload::uploadFile($request, 'pdf', 'uploads/document/');
        // if($pdf != ""){
        //     $data['pdf'] = $pdf; 
        // }
		$image = FileUpload::uploadFile($request, 'image', 'uploads/document/');
        if($image != ""){
            $data['image'] = $image; 
        }
        Model::where('id', $id)->update($data);
        $tags = $request->input('tag');
        $result = count($tags);
        DocumentTag::where('document_id',$id)->delete();
        for ($tags = 1; $tags <= $result; $tags++){
            DocumentTag::insert(['document_id' => $id, 'tag_id' => $tags]);
        }
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
