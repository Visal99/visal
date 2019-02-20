<?php

namespace App\Http\Controllers\CP\DocumentCategory;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Documents\Category as Model;
use Image;
class DocumentCategoryController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.document-category";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
       
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
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

        

        $data= $data->orderBy('data_order', 'ASC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends]);
    }
   
    public function create(){
        return view($this->route.'.create' , ['route'=>$this->route]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'slug' =>  GenerateSlug::generateSlug('documents_category', $request->input('en_name')),
                    'kh_name' =>   $request->input('kh_name'), 
                    'en_name' =>  $request->input('en_name'),
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                           'kh_name' => 'required',
                           'en_name' => 'required',
                           
                        ],
                        [
                            'kh_name.required' => 'Please input name in khmer',
                            'en_name.required' => 'Please input name in english',
                        ])->validate();

		$id=Model::insertGetId($data);

        
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'kh_name' =>   $request->input('kh_name'), 
                    'en_name' =>  $request->input('en_name'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

       Validator::make(
                        $request->all(), 
                        [
                           'kh_name' => 'required',
                           'en_name' => 'required',
                           
                        ],
                        [
                            'kh_name.required' => 'Please input name in khmer',
                            'en_name.required' => 'Please input name in english',
                        ])->validate();
        
       
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

}
