<?php

namespace App\Model\PublicWork;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
   
    protected $table = 'public_work';

   
    public function projects() {
        return $this->hasMany('App\Model\Project\Main','public_work_id');
    }

    public function mDocuments() {
        return $this->hasMany('App\Model\PublicWork\Document','public_work_id');
    }
   
}
