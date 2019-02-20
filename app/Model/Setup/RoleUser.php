<?php

namespace App\Model\Property;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
   
    protected $table = 'properties_users_roles';
    public function user(){
        return $this->belongsTo('App\Model\Property\Property');
    }
   
   
}
