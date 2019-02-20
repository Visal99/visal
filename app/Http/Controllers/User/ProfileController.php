<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Validation\Rule;

 use Hash;
 use Auth;
 use Session ;


class ProfileController extends Controller
{
    function __construct (){
    }

   
    public function edit(){  
        $user = Auth::user('user');
        return view('user.profile.edit', ['data'=>$user]);
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required|min:6|max:18',
                            'phone' => [
                                            'required',
                                            Rule::unique('users')->ignore($id)
                                        ],
                            'email' => [
                                            'required',
                                            Rule::unique('users')->ignore($id)
                                        ],
                            // 'password' => [
                            //                 'required',
                            //                 Rule::unique('users')->ignore($id)
                            //             ],
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->minWidth(500)->minHeight(500)->maxWidth(1000)->maxHeight(1000),
                            ],
                        ], 
                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                        ])->validate();
        
        $data = array(
                    'name' =>   $request->input('name'), 
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email')
                    //'password'=> $request->input('password')
                );
        $image = FileUpload::uploadImage($request, 'image', 'public/uploads/user/');
        if($image != ""){
            $data['image'] = $image; 
        }
        DB::table('users')
                        ->where('id', $id)
                        ->update($data);
        Session::flash('msg', 'Data has been saved!' );
        
        return redirect('/user/profile');
    }

    public function resetPassword (Request $request){
        $id = $request->input('id');
        $old_password = bcrypt($request->input('old_password'));
       // echo $old_password;die; 
        $check_password = DB::table('users')->where('id', $id)->first();
        $password =$check_password->password;
        
        if ($old_password == $password){ 

            Validator::make(
                        $request->all(), 
                        [
                            'new_password'         => 'required|min:6|max:18',
                            'confirm_password' => 'required|same:new_password',
                        ], 
                        [
                            'new_password.unique' => 'New password :'.$request->input('new_password').' can not be used. It has already been taken.',
                        ])->validate();
        }
        DB::table('users')
                        ->where('id', $id)
                        ->update(['password' => bcrypt($request->input('new_password'))]);
        Session::flash('msg', 'Password has been Reset!' );
        return redirect('/user/profile');
    }
    
}
