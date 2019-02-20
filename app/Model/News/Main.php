<?php

namespace App\Model\News;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'news';

    public function category() {
        return $this->belongsTo('App\Model\News\Category');
    }
   
    public function images() {
        return $this->hasMany('App\Model\News\Image','news_id');
    }
   
}
