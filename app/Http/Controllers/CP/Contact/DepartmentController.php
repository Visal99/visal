<?php

namespace App\Http\Controllers\CP\Contact;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Contact\Main as Model;
use App\Model\Contact\Message;

use Image as ImageUpload;

class DepartmentController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.contact.department";
    }
    public function index($id = 0){
        $data = Model::select('*');
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:100);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_title', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        $data= $data->where('parent_id',$id)->orderBy('created_at', 'DESC')->paginate($limit);
        $children = Model::where('parent_id', $id)->where('id', '<>', $id)->orderBy('sub_data_order', 'ASC')->get(); 
        //dd($children); die;
        $contact = Model::find($id);
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends, 'children'=>$children, 'contact'=>$contact]);
    }

    function order(Request $request){
       $string = $request->input('string');
       $data = json_decode($string);
       //print_r($data); die;
        foreach($data as $row){
            Model::where('id', $row->id)->update(['sub_data_order'=>$row->order]);
        }
       return response()->json([
          'status' => 'success',
          'msg' => 'Data has been ordered.'
      ]);
    }

 

   


 

}
