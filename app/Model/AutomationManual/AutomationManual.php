<?php

namespace App\Model\AutomationManual;
use Illuminate\Database\Eloquent\Model;

class AutomationManual extends Model
{
   
    protected $table = 'automation_manuals';
   	
   	public function automation_system(){
   	 	return $this->belongsTo('App\Model\AutomationSystem\AutomationSystem');
    }
}
