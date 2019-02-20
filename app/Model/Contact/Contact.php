<?php

namespace App\Model\Contact;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   
    protected $table = 'contacts';
   
    public function departments(){
   	 	return $this->hasMany('App\Model\ContactDepartment\ContactDepartment','contact_id');
    }
}
