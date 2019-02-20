<?php
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
    
 use App\Model\Setup\Role as Role;
 use App\Model\Setup\Access as Access;
    
 function checkPermision($route)
 {
        if(Auth::user()->position_id == 1){
        return True;
        }else{
            $permision = DB::table('permisions')->select('id')->where('route', $route)->first();
            if(count($permision) == 1){
                $permision_id = $permision->id;
                $user_id = Auth::id();
                $credentail = DB::table('users_permisions')->select('id')->where(['user_id'=>$user_id, 'permision_id'=>$permision_id])->first();
                if(count($credentail) == 1){
                    return True;
                }else{
                    return False;
                }
            }else{
                return False;
            }
        }
 }

 

?>
