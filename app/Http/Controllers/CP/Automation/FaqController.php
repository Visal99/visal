<?php

namespace App\Http\Controllers\CP\Automation;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Automation\Main as Model;
use App\Model\Automation\Faq;

use Image;

class FaqController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.automation.faq";
    }
    public function index($id = 0){
        $data = Model::find($id)->faqs();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_answer', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        $data= $data->orderBy('data_order', 'ASC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends]);
    }

    function order(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            Faq::where('id', $row->id)->update(['data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }

    public function create($id = 0){
        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id]);
    }

    public function store(Request $request) {
        $automation_id = $request->input('automation_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'automation_id' =>  $automation_id,
                    'en_question'   =>   $request->input('en_question'), 
                    'kh_question'   =>   $request->input('kh_question'), 
                    'en_answer'     =>   $request->input('en_answer'), 
                    'kh_answer'     =>   $request->input('kh_answer'), 
                    'creator_id'    =>  $user_id,
                    'created_at'    =>  $now, 
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_question' => 'required',
                            'kh_question' => 'required',
                            'en_answer' => 'required',
                            'kh_answer' => 'required',
                        ],
                        [
                            'kh_question.required' => 'Please question in khmer',
                            'en_question.required' => 'Please input questione in english',
                            'kh_answer.required' => 'Please input answer in khmer',
                            'en_answer.required' => 'Please input answer in english',
                        ])->validate();
        

       
        $id  =  Faq::insertGetId($data);

        Session::flash('msg', 'Faq has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$automation_id, 'faq_id'=>$id]));
    }

    function edit($id, $faq_id){
        $data = Model::find($id)->faqs()->find($faq_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'faq_id'=>$faq_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $automation_id = $request->input('automation_id');
        $faq_id = $request->input('faq_id');
        $data       = array(
                    'automation_id' =>  $automation_id,
                    'en_question'   =>   $request->input('en_question'), 
                    'kh_question'   =>   $request->input('kh_question'), 
                    'en_answer'     =>   $request->input('en_answer'), 
                    'kh_answer'     =>   $request->input('kh_answer'), 
                    'updater_id' =>  $user_id,
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_question' => 'required',
                            'kh_question' => 'required',
                            'en_answer' => 'required',
                            'kh_answer' => 'required',
                            
                        ],
                        [
                            
                            'kh_question.required' => 'Please question in khmer',
                            'en_question.required' => 'Please input questione in english',
                            'kh_answer.required' => 'Please input answer in khmer',
                            'en_answer.required' => 'Please input answer in english',
                        ])->validate();

        
       
        Model::find($automation_id)->faqs()->where('id', $faq_id)->update($data);
       
        Session::flash('msg', 'Faq has been Updated!');
        return redirect(route($this->route.'.edit', ['id'=>$automation_id, 'faq_id'=>$faq_id]));
    }
    
    public function trash($automation_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Faq::find($automation_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Restaurant has been deleted'
        ]);
    }


 

}
