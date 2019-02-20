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

use App\Model\AutomationSystem\AutomationSystem as Model;
use App\Model\AutomationVideo\AutomationVideo as AutomationVideo;
use App\Model\AutomationLocation\AutomationLocation as AutomationLocation;
use App\Model\AutomationFaq\AutomationFaq as AutomationFaq;
use App\Model\AutomationManual\AutomationManual as AutomationManual;
use App\Model\DocumentCategory\DocumentCategory as DocumentCategory;
use App\Model\DocumentType\DocumentType as DocumentType;
use App\Model\DocumentTag\DocumentTag as DocumentTag;
use App\Model\Document\Document as Document;
use App\Model\Tag\Tag as Tag;

class AutomationSystemController extends Controller
{
    public function listData(){
        
       
        $data = Model::orderBy('data_order','ASC')->get();
        if(!empty($data)){

            return view('user.automation_system.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
   
    public function showCreateForm(){
        return view('user.automation_system.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'en_more' =>  $request->input('en_more'), 
                    'kh_more' =>  $request->input('kh_more'),
                    'api_url' =>  $request->input('api_url'),
                    'slug'      =>   GenerateSlug::generateSlug('automation_systems', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:1|max:500',
						    'kh_title' => 'required|min:1|max:500',
                            'en_description' => 'required',
                            'kh_description' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(2000)->maxHeight(2000),
                            ],
                            'en_icon' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
                            'kh_icon' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						], 

                        [
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();
        
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/automation_system/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $en_icon = FileUpload::uploadFile($request, 'en_icon', 'uploads/automation_system/');
        if($en_icon != ""){
            $data['en_icon'] = $en_icon; 
        }else{
            $data['en_icon'] = "public/user/img/avatar.png" ;
        }

        $kh_icon = FileUpload::uploadFile($request, 'kh_icon', 'uploads/automation_system/');
        if($kh_icon != ""){
            $data['kh_icon'] = $kh_icon; 
        }else{
            $data['kh_icon'] = "public/user/img/avatar.png" ;
        }

		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.automation-system.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.automation_system.editForm', ['data'=>$data]);
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
                            'ios_link' => 'required',
                            'android_link' => 'required',
						    'en_description' => 'required',
                            'kh_description' => 'required',
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(2000)->maxHeight(2000),
                            ],
                            'icon' => [
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
                    'ios_link' =>   $request->input('ios_link'), 
                    'android_link' =>  $request->input('android_link'),
                    'link' =>  $request->input('link'),   
                    'frame' =>  $request->input('frame'),  
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'en_more' =>  $request->input('en_more'), 
                    'kh_more' =>  $request->input('kh_more'),
                    'api_url' =>  $request->input('api_url'),
                    //'slug'      =>   GenerateSlug::generateSlug('automation_systems', $request->input('en_title'),$id)
                    
                );
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/automation_system/');
        if($image != ""){
            $data['image'] = $image; 
        }
		 $icon = FileUpload::uploadFile($request, 'icon', 'uploads/automation_system/');
        if($icon != ""){
            $data['icon'] = $icon; 
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

    function order(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            Model::where('id', $row->id)->update(['data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }
//==============================================================Video
    public function listDataVideo($automation_system_id=0){
        
        $data = Model::find($automation_system_id);
        $videos = AutomationVideo::where('automation_system_id',$automation_system_id)->get();
        if(!empty($data)){

            return view('user.automation_system.listVideo', ['data'=>$data,'videos'=>$videos]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function showCreateFormVideo($automation_system_id=0){
        $data = Model::find($automation_system_id);
        return view('user.automation_system.createFormVideo',['data'=>$data]);
    }

    public function storeVideo(Request $request, $automation_system_id=0) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'type_id' =>  $request->input('type'),
                    'automation_system_id' =>  $automation_system_id,
                    'video_id' =>  $request->input('video_id')
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:100',
                            'kh_title' => 'required|min:4|max:100',
                            
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
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/automation_video/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $id=AutomationVideo::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.automation-system.edit-video',['id'=>$id,'automation_system_id'=>$automation_system_id]));
    }

    public function showEditFormVideo($automation_system_id = 0, $id = 0){
        $data = Model::find($automation_system_id);
        $automation_video = AutomationVideo::where('automation_system_id',$automation_system_id)->find($id);
        if(!empty($data)){
            return view('user.automation_system.editFormVideo', ['data'=>$data,'automation_video'=>$automation_video]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function updateVideo(Request $request, $automation_system_id=0){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:100',
                            'kh_title' => 'required|min:4|max:100',
                            
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
                    'type_id' =>  $request->input('type'),
                    'automation_system_id' =>  $automation_system_id,
                    'video_id' =>  $request->input('video_id')
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/automation_video/');
        if($image != ""){
            $data['image'] = $image; 
        }
        AutomationVideo::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

     public function destroyVideo($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        AutomationVideo::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
//==============================================================Video
    public function listDataManual($automation_system_id=0){
        
        $data = Model::find($automation_system_id);
        $manuals = AutomationManual::where('automation_system_id',$automation_system_id)->get();
        if(!empty($data)){

            return view('user.automation_system.listManual', ['data'=>$data,'manuals'=>$manuals]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
     public function showCreateFormManual($automation_system_id=0){
        $data = Model::find($automation_system_id);
        return view('user.automation_system.createFormManual',['data'=>$data]);
    }

    public function storeManual(Request $request, $automation_system_id=0) {
         $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'automation_system_id' =>  $automation_system_id
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
        $id=AutomationManual::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.automation-system.edit-manual',['id'=>$id,'automation_system_id'=>$automation_system_id]));
    }

     public function showEditFormManual($automation_system_id = 0, $id = 0){
        $data = Model::find($automation_system_id);
        $automation_manual = AutomationManual::where('automation_system_id',$automation_system_id)->find($id);
        if(!empty($data)){
            return view('user.automation_system.editFormManual', ['data'=>$data,'automation_manual'=>$automation_manual]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function updateManual(Request $request, $automation_system_id=0){
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
                    'automation_system_id' =>  $automation_system_id
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
        AutomationManual::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

     public function destroyManual($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        AutomationManual::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
    function updateStatusManual(Request $request){
      $id   = $request->input('id');
      $data = array('published' => $request->input('published'));
      AutomationManual::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'User status has been updated.'
      ]);
    }

    //=============================================== Document
     public function listDataDocument($automation_system_id=0,$slug=''){
       
        $data = Model::find($automation_system_id);
       
        $documents = DB::table('documents as d')->select('d.slug','d.id','d.published','d.en_title', 'tp.en_title as type', 'pdf', 'd.updated_at')
                        ->join('document_types as tp', 'tp.id', 'd.type_id')
                        ->join('document_tag as d_t', 'd_t.document_id', 'd.id')
                        ->join('tags as t', 't.id', 'd_t.tag_id')
                        ->where('t.slug', $slug)->get();
        return view('user.automation_system.listDocument', ['data'=>$data,'documents'=>$documents]);
        // if(!empty($data)){

        //     return view('user.public_work.listDocument', ['data'=>$data,'documents'=>$documents]);
        // }else{
        //     return response(view('errors.404'), 404);
        // }
    }
    public function showCreateFormDocument($automation_system_id=0){
        $data = Model::find($automation_system_id);
         $categories = DocumentCategory::get();
        $types = DocumentType::get();
        return view('user.automation_system.createFormDocument',['data'=>$data,'categories'=>$categories,'types'=>$types]);
    }

    public function showEditFormDocument($automation_system_id = 0, $id = 0){
        //print_r($slug);die;
        $slug = Model::find($automation_system_id)->slug;
        $categories = DocumentCategory::get();
        $types = DocumentType::get();
        $data = Model::find($automation_system_id);
        $document = Document::find($id);
        if(!empty($data)){
            return view('user.automation_system.editFormDocument', ['data'=>$data,'document'=>$document,'categories'=>$categories,'types'=>$types]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function storeDocument(Request $request, $automation_system_id=0) {
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
        
        $slug =Model::find($automation_system_id)->slug;
        $tag_id =Tag::where('slug',$slug)->first()->id;
        

        //$tags = $request->input('tag');
       
        DocumentTag::insert(['document_id' => $id, 'tag_id' => $tag_id]);
        
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.automation-system.edit-document',['id'=>$id,'automation_system_id'=>$automation_system_id]));
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

//==============================================================Location
    public function listDataLocation($automation_system_id=0){
        
        $data = Model::find($automation_system_id);
        $locations = AutomationLocation::where('automation_system_id',$automation_system_id)->get();
        if(!empty($data)){

            return view('user.automation_system.listLocation', ['data'=>$data,'locations'=>$locations]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function showCreateFormLocation($automation_system_id=0){
        $data = Model::find($automation_system_id);
        return view('user.automation_system.createFormLocation',['data'=>$data]);
    }

    public function storeLocation(Request $request, $automation_system_id=0) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'phone' =>  $request->input('phone'),
                    'en_address' =>   $request->input('en_address'), 
                    'kh_address' =>  $request->input('kh_address'),
                    'lat' =>  $request->input('lat'),
                    'lng' =>  $request->input('lng'),
                    'url' =>  $request->input('url'),
                    'automation_system_id' =>  $automation_system_id
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:1|max:250',
                            'kh_title' => 'required|min:1|max:250',
                        ], 

                        [
                           
                        ])->validate();
        
       if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
       
        $id=AutomationLocation::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.automation-system.edit-location',['id'=>$id,'automation_system_id'=>$automation_system_id]));
    }

    public function showEditFormLocation($automation_system_id = 0, $id = 0){
        $data = Model::find($automation_system_id);
        $automation_location = AutomationLocation::where('automation_system_id',$automation_system_id)->find($id);
        if(!empty($data)){
            return view('user.automation_system.editFormLocation', ['data'=>$data,'automation_location'=>$automation_location]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function updateLocation(Request $request, $automation_system_id=0){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:1|max:250',
                            'kh_title' => 'required|min:1|max:250',
                            
                        ],
                        [
                            
                        ])->validate();

        
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'phone' =>  $request->input('phone'),
                    'en_address' =>   $request->input('en_address'), 
                    'kh_address' =>  $request->input('kh_address'),
                    'lat' =>  $request->input('lat'),
                    'lng' =>  $request->input('lng'),
                    'url' =>  $request->input('url'),
                    'automation_system_id' =>  $automation_system_id
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        
        AutomationLocation::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

     public function destroyLocation($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        AutomationLocation::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }

    //==============================================================Faq
    public function listDataFaq($automation_system_id=0){
        
        $data = Model::find($automation_system_id);
        $faqs = AutomationFaq::where('automation_system_id',$automation_system_id)->orderBy('data_order','ASC')->get();
        if(!empty($data)){

            return view('user.automation_system.listFaq', ['data'=>$data,'faqs'=>$faqs]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function showCreateFormFaq($automation_system_id=0){
        $data = Model::find($automation_system_id);
        return view('user.automation_system.createFormFaq',['data'=>$data]);
    }

    public function storeFaq(Request $request, $automation_system_id=0) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'en_description' =>   $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'automation_system_id' =>  $automation_system_id
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:1|max:250',
                            'kh_title' => 'required|min:1|max:250',
                        ], 

                        [
                           
                        ])->validate();
        
       if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
       
        $id=AutomationFaq::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.automation-system.edit-faq',['id'=>$id,'automation_system_id'=>$automation_system_id]));
    }

    public function showEditFormFaq($automation_system_id = 0, $id = 0){
        $data = Model::find($automation_system_id);
        $automation_faq = AutomationFaq::where('automation_system_id',$automation_system_id)->find($id);
        if(!empty($data)){
            return view('user.automation_system.editFormFaq', ['data'=>$data,'automation_faq'=>$automation_faq]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function updateFaq(Request $request, $automation_system_id=0){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:1|max:250',
                            'kh_title' => 'required|min:1|max:250',
                            
                        ],
                        [
                            
                        ])->validate();

        
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'en_description' =>   $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'automation_system_id' =>  $automation_system_id
                    
                );
        if($request->input('publish')=="")
        {
            $data['published']=0;
        }else{
            $data['published']=1;
        }
        
        AutomationFaq::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

     public function destroyFaq($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        AutomationFaq::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }

    function orderFaq(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            AutomationFaq::where('id', $row->id)->update(['data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }
}
