<?php

namespace App\Model\Project;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   
    protected $table = 'projects';
   
   public function public_work(){
   	 	return $this->belongsTo('App\Model\PublicWork\PublicWork');
    }
}
