<?php

namespace App\Http\Controllers\User;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Album\Album as Model;
use App\Model\AlbumImage\AlbumImage as AlbumImage;

class AlbumsController extends Controller
{
    public function listData(){
        
        
        $data = Model::get();
        if(!empty($data)){

            return view('user.album.list', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    
    public function showCreateForm(){
        
        return view('user.album.createForm');
    }
    public function store(Request $request) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'), 
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'slug'      =>   GenerateSlug::generateSlug('albums', $request->input('en_title'))
                    
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:50',
						    'kh_title' => 'required|min:4|max:50',
                            'en_description' => 'required',
                            'kh_description' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
						], 

                        [
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();
        
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/album/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route('user.album.edit', $id));
    }

    public function showEditForm($id = 0){
        $data = Model::find($id);
        if(!empty($data)){
            return view('user.album.editForm', ['data'=>$data]);
        }else{
            return response(view('errors.404'), 404);
        }
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
        				$request->all(), 
			        	[
						    'en_title' => 'required|min:4|max:50',
                            'kh_title' => 'required|min:4|max:50',
						    'en_description' => 'required',
                            'kh_description' => 'required',
                            'image' => [
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
                    'en_description' =>  $request->input('en_description'), 
                    'kh_description' =>  $request->input('kh_description'),
                    'slug'      =>   GenerateSlug::generateSlug('albums', $request->input('en_title'), $id)
                    
                );
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/album/');
        if($image != ""){
            $data['image'] = $image; 
        }
		
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
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
//=============================================== Create Image
    public function listImage($id = 0){
        $data = Model::find($id);
        $images = AlbumImage::where('album_id',$id)->get();

        if(!empty($data)){
            return view('user.album.image', ['data'=>$data,'images'=>$images]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function showCreateImageForm($id = 0){
        $data = Model::find($id);
        return view('user.album.createImageForm',['data'=>$data]);
    }
     public function store_image(Request $request, $albumid = 0) {
        $data = array(
                    'en_title' =>   $request->input('en_title'), 
                    'kh_title' =>  $request->input('kh_title'),
                    'album_id' =>  $albumid
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:50',
                            'kh_title' => 'required|min:4|max:50',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(10)->minHeight(10)->maxWidth(1000)->maxHeight(1000),
                            ],
                        ], 

                        [
                            'image.dimensions' => 'Please provide valide image with height between 100-500px and width between 100-500px.',
                        ])->validate();
        
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/album/');
        if($image != ""){
            $data['image'] = $image; 
        }else{
            $data['image'] = "public/user/img/avatar.png" ;
        }
        $id=AlbumImage::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('user.album.image',$albumid ));
    }
    public function showEditImageForm($albumid = 0,$id = 0){
        $data_image = AlbumImage::where(array('id' => $id,'album_id' => $albumid ))->first();
        $data = Model::find($albumid);
        if(!empty($data)){
            return view('user.album.editImageForm', ['data'=>$data,'data_image'=>$data_image]);
        }else{
            return response(view('errors.404'), 404);
        }
    }
    public function updateImage(Request $request,$albumid = 0,$id = 0){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'en_title' => 'required|min:4|max:50',
                            'kh_title' => 'required|min:4|max:50',
                            'image' => [
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
                    'album_id' =>  $albumid
                );
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/album/');
        if($image != ""){
            $data['image'] = $image; 
        }
        
        AlbumImage::where(array('id'=>$albumid,'album_id'=>$albumid))->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('published' => $request->input('publish'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'User status has been updated.'
      ]);
    }
    public function destroyImage($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::guard('user')->id()]);
        AlbumImage::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }
   
}
