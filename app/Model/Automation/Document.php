<?php

namespace App\Model\Automation;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   
    protected $table = 'automations_documents';
   
    public function automation() {
        return $this->belongsTo('App\Model\Automation\Main');
    }

    public function document() {
        return $this->belongsTo('App\Model\Documents\Main');
    }
   
}
