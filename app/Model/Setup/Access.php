<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{
   
    use SoftDeletes;
    protected $table = 'accesses';
    public function roles() {
        return $this->belongsToMany('App\Model\Setup\Role', 'roles_accesses');
    }
    public function accessRoles() {
        return $this->hasMany('App\Model\Setup\RoleAccess');
    }

}
