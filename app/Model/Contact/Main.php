<?php

namespace App\Model\Contact;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'contact';

   
    public function messages() {
        return $this->hasMany('App\Model\Contact\Message','contact_id');
    }
   
}
