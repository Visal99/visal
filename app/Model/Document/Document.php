<?php

namespace App\Model\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends \Eloquent
{
    //use SoftDeletes;
    protected $table = 'documents';
    
    public function type(){
   	 	return $this->hasOne('App\Model\DocumentType\DocumentType','id','type_id');
    }
    public function category(){
   	 	return $this->BelongsTo('App\Model\DocumentCategory\DocumentCategory','catagory_id');
    }

    public function documentTag(){
      return $this->hasMany('App\Model\DocumentTag\DocumentTag');
    }
    public function tags()
    {
   	 return $this->belongsToMany('App\Model\Tag\Tag', 'document_tag');
   	}

   	
    
}
