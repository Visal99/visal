<?php

namespace App\Model\PublicWork;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   
    protected $table = 'publicworks_documents';
   
    public function publicWork() {
        return $this->belongsTo('App\Model\Automation\Main', 'public_work_id');
    }

    public function document() {
        return $this->belongsTo('App\Model\Documents\Main', 'document_id');
    }
   
}
