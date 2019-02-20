<?php

namespace App\Model\Press;
use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
   
    protected $table = 'presses';
   
    public function category(){
   	 	return $this->belongsTo('App\Model\PressCategory\PressCategory');
    }
    
}
