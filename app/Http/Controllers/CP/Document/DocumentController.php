<?php

namespace App\Http\Controllers\CP\Document;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Documents\Main as Model;
use App\Model\Documents\Category as Category;
use App\Model\Automation\Main as Automation;
use App\Model\PublicWork\Main as PublicWork;
class DocumentController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.document";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
       
        $categories = Category::get();
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $category       =   isset($_GET['category'])?$_GET['category']:0;
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_title', 'like', '%'.$key.'%')->orWhere('kh_title', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }

        if( $category > 0 ){
            $data = $data->where('category_id', $category);
            $appends['category'] = $category;
        }

        $data= $data->orderBy('id', 'Desc')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends,'categories'=>$categories]);
    }
   
    public function create(){
        $categories = Category::get();
      
        return view($this->route.'.create' , ['route'=>$this->route,'categories'=>$categories]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'category_id' =>   $request->input('category'), 
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'google_drive_url' =>   $request->input('google_link'), 
                    'official_published_date' =>   $request->input('official_published_date'),
                    'event_date' =>   $request->input('event_date'), 
                    'creator_id' => $user_id,
                    'created_at' => $now
                );

        //dd($data);
        
        Session::flash('invalidData', $data );
       Validator::make(
                        $request->all(), 
                        [
                           //'category_id' => 'required|exists:documents_category,id',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            
                        ],
                        [
                            'category_id.required' => 'Please Select category',
                            'category_id.exists' => 'Please Select category',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();

        if($request->input('status')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
            $data['published_at']=$now;
        }
       

		$id=Model::insertGetId($data);

       
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
       
        $categories = Category::get();
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'categories'=>$categories]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'category_id' =>   $request->input('category'), 
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'google_drive_url' =>   $request->input('google_link'),
                    'official_published_date' =>   $request->input('official_published_date'),
                    'event_date' =>   $request->input('event_date'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

        Validator::make(
                        $request->all(), 
                        [
                           //'category_id' => 'required|exists:documents_category,id',
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            
                        ],
                        [
                            'category_id.required' => 'Please Select category',
                            'category_id.exists' => 'Please Select category',
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();
        if($request->input('status')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
       
        Model::where('id', $id)->update($data);

        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
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
    public function trash($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Data has been deleted'
        ]);
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Published status has been updated.'
      ]);
    }


    public function publicService($id=0){
        $automations = Automation::get();
        $data = Model::find($id)->mPublicServices;
        return view($this->route.'.public-service', ['route'=>$this->route, 'id'=>$id, 'data'=>$data, 'automations'=>$automations]);
    }
    public function checkPublicService($id=0){
        $document_id        = $_GET['document_id'];
        $automation_id   = $_GET['automation_id'];
        $now            = date('Y-m-d H:i:s');

        $document = Model::find($document_id);
        $dataPermision = $document->mPublicServices()->select('automation_id')->get(); 

        $is_permision_existed = 0;
        foreach($dataPermision as $row){
            if($row->automation_id == $automation_id){
                $is_permision_existed = 1;
            }
        }
       
        if($is_permision_existed == 1){
            $document->mPublicServices()->where('automation_id', $automation_id)->delete();
            return response()->json([
                  'status' => 'success',
                  'msg' => 'Public Work has been removed.'
            ]);
        }else{
            $data_permision=array(
                'document_id' => $document_id,
                'automation_id' => $automation_id,
                'created_at' => $now, 
                'updated_at' => $now
                );
            $document->mPublicServices()->insert($data_permision);
             return response()->json([
                  'status' => 'success',
                  'msg' => 'Public Work has been added.'
              ]);
        }
    }

    public function publicWork($id=0){
        $public_works = PublicWork::get();
        $data = Model::find($id)->mPublicWorks;
        return view($this->route.'.public-work', ['route'=>$this->route, 'id'=>$id, 'data'=>$data, 'public_works'=>$public_works]);
    }
    public function checkpublicWork($id=0){
        $document_id        = $_GET['document_id'];
        $public_work_id   = $_GET['public_work_id'];
        $now            = date('Y-m-d H:i:s');

        $public_work = Model::find($document_id);
        $dataPermision = $public_work->mPublicWorks()->select('public_work_id')->get(); 

        $is_permision_existed = 0;
        foreach($dataPermision as $row){
            if($row->public_work_id == $public_work_id){
                $is_permision_existed = 1;
            }
        }
       
        if($is_permision_existed == 1){
            $public_work->mPublicWorks()->where('public_work_id', $public_work_id)->delete();
            return response()->json([
                  'status' => 'success',
                  'msg' => 'Public Work has been removed.'
            ]);
        }else{
            $data_permision=array(
                'document_id' => $document_id,
                'public_work_id' => $public_work_id,
                'created_at' => $now, 
                'updated_at' => $now
                );
            $public_work->mPublicWorks()->insert($data_permision);
             return response()->json([
                  'status' => 'success',
                  'msg' => 'Public Work has been added.'
              ]);
        }
    }

}
