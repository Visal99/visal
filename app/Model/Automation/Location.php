<?php

namespace App\Model\Automation;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   
    protected $table = 'automation_locations';
   
    public function automation() {
        return $this->belongsTo('App\Model\Automation\Main');
    }
   
}
