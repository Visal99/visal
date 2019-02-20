<?php

namespace App\Model\AutomationLocation;
use Illuminate\Database\Eloquent\Model;

class AutomationLocation extends Model
{
   
    protected $table = 'automation_locations';
   
   public function automation_system(){
   	 	return $this->belongsTo('App\Model\AutomationSystem\AutomationSystem');
    }
}
