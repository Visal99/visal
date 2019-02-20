<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use App\Model\PublicWork\PublicWork as PublicWork;
use App\Model\Project\Project as Project;

class PublicWorksController extends FrontendController
{
    public function index($locale = "en", $category=""){
        $defaultData = $this->defaultData($locale);
        //$categories = array("expressways", "sewage-systems", "road-infrastructure", "public-works-technical", "road-map");
       
       
        $data = PublicWork::select($locale.'_title as title',$locale.'_content as content','id')->where('slug', $category)->first();
            
        if (sizeof($data) == 1) {
            $documents = DB::table('documents as d')->select('d.slug', 'd.'.$locale.'_title as title', 'tp.'.$locale.'_title as type', 'pdf', 'd.updated_at')
                        ->join('document_types as tp', 'tp.id', 'd.type_id')
                        ->join('document_tag as d_t', 'd_t.document_id', 'd.id')
                        ->join('tags as t', 't.id', 'd_t.tag_id')
                        ->where('t.slug', $category)->get();
             return view('frontend.public-works', ['category'=>$category,'locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data, "documents" => $documents]);
        
        }else{
            return view('errors.404');
        }
    }
    public function viewProject($locale = "en", $slug=""){
    	$defaultData = $this->defaultData($locale);
        $projects = Project::select($locale.'_title as title',$locale.'_background as background','id','image','slug')->get();
        $data = Project::select($locale.'_title as title',$locale.'_background as background',$locale.'_construction_type as construction_type',$locale.'_category as category',$locale.'_province as province',$locale.'_location as location',$locale.'_consultant as consultant',$locale.'_authority as authority',$locale.'_constructor as constructor',$locale.'_period as period',$locale.'_note as note','id')->where('slug', $slug)->first();
    	return view('frontend.project-view', ['locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data,'projects'=>$projects]);
    }
}

