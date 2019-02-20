<?php

namespace App\Model\News;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   
    protected $table = 'news_image';
   
    public function new() {
        return $this->belongsTo('App\Model\News\Main','news_id');
    }
   
}
