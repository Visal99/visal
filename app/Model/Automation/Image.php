<?php

namespace App\Model\Automation;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   
    protected $table = 'automation_images';
   
    public function automation() {
        return $this->belongsTo('App\Model\Automation\Main');
    }
   
}
