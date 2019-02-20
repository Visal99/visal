<?php

namespace App\Http\Controllers\CP\PublicWork;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\PublicWork\Main as Model;
use App\Model\Project\Main as Project;

use Image;

class ProjectController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.public_work.project";
    }
    public function index($id = 0){
        $data = Model::find($id)->projects();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_title', 'Like', '%'.$key.'%');
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
            Project::where('id', $row->id)->update(['data_order'=>$row->order]);
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
        $public_work_id = $request->input('public_work_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'public_work_id' =>  $public_work_id,
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'kh_province' =>   $request->input('kh_province'), 
                    'en_province' =>  $request->input('en_province'),
                    'kh_location' =>   $request->input('kh_location'), 
                    'en_location' =>  $request->input('en_location'),
                    'kh_consultant' =>   $request->input('kh_consultant'), 
                    'en_consultant' =>  $request->input('en_consultant'),
                    'kh_authority' =>   $request->input('kh_authority'), 
                    'en_authority' =>  $request->input('en_authority'),
                    'kh_constructor' =>   $request->input('kh_constructor'), 
                    'en_constructor' =>  $request->input('en_constructor'),
                    'kh_period' =>   $request->input('kh_period'), 
                    'en_period' =>  $request->input('en_period'),
                    'is_published' =>  $request->input('status'),
                    'published_at' =>  $now,
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                            ],
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                            'image.required' => 'Please input your image',
                        ])->validate();
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/project/image/'.$imagename));
            $data['image_url']='public/uploads/project/image/'.$imagename;
        }

       
        $id  =  Project::insertGetId($data);

        Session::flash('msg', 'Data has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$public_work_id, 'project_id'=>$id]));
    }

    function edit($id, $project_id){
        $data = Model::find($id)->projects()->find($project_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'project_id'=>$project_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $public_work_id = $request->input('public_work_id');
        $project_id = $request->input('project_id');
        $data       = array(
                    'public_work_id' =>  $public_work_id,
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'kh_content' =>   $request->input('kh_content'), 
                    'en_content' =>  $request->input('en_content'),
                    'kh_province' =>   $request->input('kh_province'), 
                    'en_province' =>  $request->input('en_province'),
                    'kh_location' =>   $request->input('kh_location'), 
                    'en_location' =>  $request->input('en_location'),
                    'kh_consultant' =>   $request->input('kh_consultant'), 
                    'en_consultant' =>  $request->input('en_consultant'),
                    'kh_authority' =>   $request->input('kh_authority'), 
                    'en_authority' =>  $request->input('en_authority'),
                    'kh_constructor' =>   $request->input('kh_constructor'), 
                    'en_constructor' =>  $request->input('en_constructor'),
                    'kh_period' =>   $request->input('kh_period'), 
                    'en_period' =>  $request->input('en_period'),
                    'is_published' =>  $request->input('status'),
                    'published_at' =>  $now,
                    'updater_id' =>  $user_id,
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                           'kh_title' => 'required',
                           'en_title' => 'required',
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                            ],
                        ],
                        [
                            'kh_title.required' => 'Please input title in khmer',
                            'en_title.required' => 'Please input title in english',
                            'image.required' => 'Please input your image',
                        ])->validate();

        
       if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(960, 640)->save(public_path('uploads/project/image/'.$imagename));
            $data['image_url']='public/uploads/project/image/'.$imagename;
        }
        Model::find($public_work_id)->projects()->where('id', $project_id)->update($data);
       
        Session::flash('msg', 'Data has been Updated!');
        return redirect(route($this->route.'.edit', ['id'=>$public_work_id, 'project_id'=>$project_id]));
    }
    
    public function trash($project_id){
        $user_id    = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Project::find($project_id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Data has been deleted'
        ]);
    }

    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Project::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Published status has been updated.'
      ]);
    }
 

}
