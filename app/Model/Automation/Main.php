<?php

namespace App\Model\Automation;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'automation';

   
    public function faqs() {
        return $this->hasMany('App\Model\Automation\Faq','automation_id');
    }
    public function images() {
        return $this->hasMany('App\Model\Automation\Image');
    }
    public function locations() {
        return $this->hasMany('App\Model\Automation\Location','automation_id');
    }
   
}
