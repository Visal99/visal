<?php

namespace App\Model\Project;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'projects';

   
    public function public_work() {
        return $this->belongsTo('App\Model\Project\Category','public_work_id');
    }
   
}
