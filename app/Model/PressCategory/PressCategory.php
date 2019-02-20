<?php

namespace App\Model\PressCategory;
use Illuminate\Database\Eloquent\Model;

class PressCategory extends Model
{
   
    protected $table = 'press_categories';
   	
   	public function presses(){
   	 	return $this->hasMany('App\Model\Press\Press','category_id');
    }

}
