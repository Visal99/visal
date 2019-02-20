<?php

namespace App\Model\PublicWork;
use Illuminate\Database\Eloquent\Model;

class PublicWork extends Model
{
   
    protected $table = 'public_works';
   
    public function projects(){
   	 	return $this->hasMany('App\Model\Project\Project');
    }
}
