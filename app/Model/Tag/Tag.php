<?php

namespace App\Model\Tag;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   
    protected $table = 'tags';
    public function tagDocument(){
   	 	return $this->hasMany('App\Model\DocumentTag\DocumentTag');
    }
    public function documents()
    {
        return $this->belongsToMany('App\Model\Document\Document', 'document_tag');
    }
}
