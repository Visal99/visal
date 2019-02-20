<?php

namespace App\Model\News;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    protected $table = 'news_category';
   
    public function news() {
        return $this->hasMany('App\Model\News\Main');
    }
}
