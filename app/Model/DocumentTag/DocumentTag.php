<?php

namespace App\Model\DocumentTag;
use Illuminate\Database\Eloquent\Model;

class DocumentTag extends Model
{
   
    protected $table = 'document_tag';
   	public function documents(){
   	 	return $this->hasMany('App\Model\Document\Document');
    }
    public function tags(){
   	 	return $this->hasMany('App\Model\Tag\Tag');
    }
   
}
