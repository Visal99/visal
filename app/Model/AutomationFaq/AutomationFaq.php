<?php

namespace App\Model\AutomationFaq;
use Illuminate\Database\Eloquent\Model;

class AutomationFaq extends Model
{
   
    protected $table = 'automation_faqs';
   
   public function automation_system(){
   	 	return $this->belongsTo('App\Model\AutomationSystem\AutomationSystem');
    }
}
