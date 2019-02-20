<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\PublicWork\Main as PublicWork;  
use App\Model\Project\Main as Project;  

class PublicWorkController extends FrontendController
{
    public function index($locale = "en", $slug = '') {
       
        $data = PublicWork::select('id', $locale.'_title as title', 'slug', $locale.'_content as content')->where(['is_published'=>1, 'slug'=>$slug])->first();
        
        if($data){
            $defaultData = $this->defaultData($locale);

            return view('frontend.public-work.index', 
                [
                    'locale'=>$locale, 
                    'defaultData'=>$defaultData,
                    'title' =>$data->title, 
                    'subActive' => $data->slug,
                    'content' => $data->content, 
                    'documents' => [], 
                    'projects' => $data->projects()->select($locale.'_title as title','image_url','id')->where('is_published',1)->get()
                ]);
        }else{
            return view('errors.404');
        }
            
    }

    public function viewProject($locale = "en", $id = 0){
       $data = Project::select('id', $locale.'_title as title', $locale.'_content as content',$locale.'_province as province',$locale.'_location as location',$locale.'_consultant as consultant',$locale.'_authority as authority',$locale.'_constructor as constructor',$locale.'_period as period','image_url')->where(['is_published'=>1, 'id'=>$id])->first();
       if($data){
            $defaultData = $this->defaultData($locale);
            return view('frontend.public-work.project-view', 
                    [
                        'locale'=>$locale, 
                        'defaultData'=>$defaultData, 
                        'data' => $data
                    ]);
       }else{
            return view('errors.404');
       }
    }
}
