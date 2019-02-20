<?php

namespace App\Model\AutomationSystem;
use Illuminate\Database\Eloquent\Model;

class AutomationSystem extends Model
{
   
    protected $table = 'automation_systems';
   
   	public function manuals(){
   	 	return $this->hasMany('App\Model\AutomationManual\AutomationManual');
    }

    public function videos(){
   	 	return $this->hasMany('App\Model\AutomationVideo\AutomationVideo');
    }
    
    public function locations(){
   	 	return $this->hasMany('App\Model\AutomationLocation\AutomationLocation');
    }
    public function faqs(){
      return $this->hasMany('App\Model\AutomationFaq\AutomationFaq');
    }
}
