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
use App\Model\Automation\Location;

use Image;

class LocationController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.automation.location";
    }
    public function index($id = 0){
        $data = Model::find($id)->locations();
        
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
            Location::where('id', $row->id)->update(['data_order'=>$row->order]);
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
                    'en_title'   =>   $request->input('en_title'), 
                    'kh_title'   =>   $request->input('kh_title'), 
                    'phone'     =>   $request->input('phone'), 
                    'lat'     =>   $request->input('lat'), 
                    'lng'     =>   $request->input('lng'), 
                    'en_address'   =>   $request->input('en_address'), 
                    'kh_address'   =>   $request->input('kh_address'), 
                    'en_working_hour'   =>   $request->input('en_working_hour'), 
                    'kh_working_hour'   =>   $request->input('kh_working_hour'), 
                    'google_map_url'   =>   $request->input('url'), 
                    'creator_id'    =>  $user_id,
                    'created_at'    =>  $now, 
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required',
                            'kh_title' => 'required',
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();
        

       
        $id  =  Location::insertGetId($data);

        Session::flash('msg', 'Data has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$automation_id, 'location_id'=>$id]));
    }

    function edit($id, $location_id){
        $data = Model::find($id)->locations()->find($location_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'location_id'=>$location_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $automation_id = $request->input('automation_id');
        $location_id = $request->input('location_id');
        $data       = array(
                    'automation_id' =>  $automation_id,
                    'en_title'   =>   $request->input('en_title'), 
                    'kh_title'   =>   $request->input('kh_title'), 
                    'phone'     =>   $request->input('phone'), 
                    'lat'     =>   $request->input('lat'), 
                    'lng'     =>   $request->input('lng'), 
                    'en_address'   =>   $request->input('en_address'), 
                    'kh_address'   =>   $request->input('kh_address'), 
                    'en_working_hour'   =>   $request->input('en_working_hour'), 
                    'kh_working_hour'   =>   $request->input('kh_working_hour'), 
                    'google_map_url'   =>   $request->input('url'), 
                    'updater_id' =>  $user_id,
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required',
                            'kh_title' => 'required',
                            
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                        ])->validate();

        
       
        Model::find($automation_id)->locations()->where('id', $location_id)->update($data);
       
        Session::flash('msg', 'Data has been Updated!');
        return redirect(route($this->route.'.edit', ['id'=>$automation_id, 'location_id'=>$location_id]));
    }
    
    public function trash($automation_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Location::find($automation_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Restaurant has been deleted'
        ]);
    }


 

}
