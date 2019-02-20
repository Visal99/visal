<?php

namespace App\Http\Controllers\User;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;

use App\Model\Content\Contents as Model;



class ContentsController extends Controller
{
    
    function __construct (){
       
    }

    public function listData($page = ""){   
      $data = Model::whereNotIn('page',['home'])->get();
      if(!empty($data)){
        return view('user.content.list', ['page' => $page, 'data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    public function showEditForm(Request $request,$slug = ""){   
      $data = Model::where('slug', $slug)->first();
      $menu = $request->input('menu');
      if(!empty($data)){
        return view('user.content.editForm', ['page'=>$menu,'data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    
    public function update(Request $request){
        
      $id = $request->input('id');
      $slug = $request->input('slug');
      $image = "";
      $validate = array(
                      'kh_content' => 'required',
                      'en_content' => 'required',
                  );
      $data = array(
                  'kh_content' =>   $request->input('kh_content'), 
                  'en_content' =>  $request->input('en_content')
              );

      if($request->input('image_required')){
          $validate['image'] = array( 'sometimes',
                                      'required',
                                      'mimes:jpeg,png',
                                      Rule::dimensions()->maxWidth($request->input('width'))->maxHeight($request->input('height'))
                                      );
          
          
      }
      //print_r($validate); die;
      Validator::make($request->all(), $validate)->validate();
  
      if($request->input('image_required')){
          $image = FileUpload::uploadFile($request, 'image', 'uploads/content');
          if($image != ""){
              $data['image'] = $image; 
          }
      }

      if($slug == 'minister-message'){
          $kh_image = FileUpload::uploadFile($request, 'kh_image', 'uploads/content');
          if($kh_image != ""){
              $data['kh_image'] = $kh_image; 
          }
      }

      Model::where('id', $id)->update($data);
      Session::flash('msg', 'Data has been updated!' );
      return redirect()->back();

    }

   
    
}
