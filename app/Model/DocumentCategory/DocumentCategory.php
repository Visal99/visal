<?php

namespace App\Model\DocumentCategory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
   
    protected $table = 'document_categories';
   
    public function documents(){
   	 	return $this->hasMany('App\Model\Document\Document','category_id');
    }
}
