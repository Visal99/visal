<?php

namespace App\Model\Documents;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    protected $table = 'documents_category';
   
    public function documents() {
        return $this->hasMany('App\Model\Documents\Main', 'category_id');
    }
}
