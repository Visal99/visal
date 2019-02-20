<?php

namespace App\Model\AutomationVideo;
use Illuminate\Database\Eloquent\Model;

class AutomationVideo extends Model
{
   
    protected $table = 'automation_videos';
   
   public function automation_system(){
   	 	return $this->belongsTo('App\Model\AutomationSystem\AutomationSystem');
    }
}
