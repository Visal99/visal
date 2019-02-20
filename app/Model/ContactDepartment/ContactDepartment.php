<?php

namespace App\Model\ContactDepartment;
use Illuminate\Database\Eloquent\Model;

class ContactDepartment extends Model
{
   
    protected $table = 'contact_departments';
   
   	public function conatact(){
   	 	return $this->belongsTo('App\Model\Contact\Contact','contact_id');
    }
}
