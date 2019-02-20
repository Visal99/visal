<?php

namespace App\Http\Controllers\CP\Setup;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Model\Setup\Role as Model;
use App\Model\Setup\Access; 

class RoleController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.setup.role";
    }
    public function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data = Model::orderBy('id', 'DESC')->get();
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data]);
    }
   
    public function create(){
        return view($this->route.'.create', ['route'=>$this->route]);
    }

    public function store(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $data = array(
                    'name' =>   $request->input('name'),
                    'note' =>   $request->input('note'),
                    'creator_id' =>   $user_id,
                    'updater_id' =>   $user_id,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required'
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
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Validator::make(
        				$request->all(), 
			        	[
                            
                            'name' => 'required'
                            
                        ])->validate();

		
		$data = array(
                    'name' =>   $request->input('name'),
                    'note' =>   $request->input('note'),
                    'updater_id' =>   $request->input('user_id'),
                );

       
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

    public function trash($id){
        Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
   
    public function accesses($id = 0){
        $this->validObj($id);
        $accesses = Access::get();
        //dd($accesses);
        $data = Model::find($id)->roleAccesses()->select('access_id')->get();
        return view($this->route.'.accesses', ['route'=>$this->route, 'id'=>$id, 'accesses'=>$accesses, 'data'=>$data]);
    }


    public function check(Request $request){
        $role_id    = $_GET['role_id'];
        $access_id  = $_GET['access_id'];
        $user_id  = Auth::id();
        $now        = date('Y-m-d H:i:s');
       
        
        $role = Model::find($role_id);
        $data = $role->roleAccesses()->where(['access_id' => $access_id])->first();
        if(sizeof($data) == 1){
            $role->roleAccesses()->where('id', $data->id)->delete();
            return response()->json([
                  'status' => 'success',
                  'msg' => 'Property access has been removed.'
            ]);
        }else{
            $dataAccess=array(
                'role_id' => $role_id,
                'access_id' => $access_id,
                'creator_id' =>   $user_id,
                'created_at' => $now, 
                'updated_at' => $now
                );
             $role->roleAccesses()->insert($dataAccess);
             return response()->json([
                  'status' => 'success',
                  'msg' => 'Property access has been added.'
              ]);
        }
    }

   
   
}
