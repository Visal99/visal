<?php

namespace App\Model\Automation;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
   
    protected $table = 'automation_faqs';
   
    public function automation() {
        return $this->belongsTo('App\Model\Automation\Main','automation_id');
    }
   
}
