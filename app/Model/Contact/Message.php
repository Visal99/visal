<?php

namespace App\Model\Contact;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   
    protected $table = 'contact_messages';
   
    public function contact() {
        return $this->belongsTo('App\Model\Contact\Main','contact_id');
    }
   
}
