<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
   
    protected $table = 'roles_accesses';
    public function role(){
        return $this->belongsTo('App\Model\Setup\Role');
    }
   
   
}
