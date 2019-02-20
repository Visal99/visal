<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
 use Hash;
 use Auth;
 use Session ;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;

use App\Model\Video\Video as Model;


class VideoController extends Controller
{
    
    function __construct (){
       
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.video.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                $request->all(), 
                [
                    'url' => 'required|min:1|max:550',
                    'en_title' => 'required|min:1|max:550',  
                    'kh_title' => 'required|min:1|max:550',      
            ],
                        [
                            
                        ])->validate();

    
        $data = array( 
                        'url' =>  $request->input('url'),
                        'en_title' =>  $request->input('en_title'),
                        'kh_title' =>  $request->input('kh_title')
                    );
           
        $image = FileUpload::uploadFile($request, 'image', 'uploads/video/');
            if($image != ""){
                $data['image'] = $image; 
            }
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!');
        return redirect()->back();
    }

   
}
