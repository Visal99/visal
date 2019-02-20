<?php

namespace App\Model\Documents;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'document';
    public function category() {
        return $this->belongsTo('App\Model\Documents\Category', 'category_id');
    }

    public function mPublicServices() {
        return $this->hasMany('App\Model\Automation\Document', 'document_id');
    }

     public function mPublicWorks() {
        return $this->hasMany('App\Model\PublicWork\Document', 'document_id');
    }
  
   
}
