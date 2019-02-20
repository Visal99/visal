<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
   
    use SoftDeletes;
    protected $table = 'roles';
    public function accesses() {
        return $this->belongsToMany('App\Model\Setup\Access', 'roles_accesses');
    }
    public function roleAccesses() {
        return $this->hasMany('App\Model\Setup\RoleAccess');
    }

}
