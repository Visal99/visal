<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;
use App\Model\Documents\Category; 
use App\Model\Documents\Main as Document; 
class DocumentController extends FrontendController
{
    public function index($locale = "en", $category = '') {

    	

        $subActive = '';
        $dataCateogry = Category::select($locale.'_name as title', 'slug')->where('slug', $category)->first();
        if($dataCateogry){
            $title = $dataCateogry->title;
            $subActive = $dataCateogry->slug;
        }
        $data = Document::select('id', $locale.'_title as title', 'google_drive_url', 'event_date', 'category_id', 'official_published_date')->with(['category:id,slug,'.$locale.'_name as title'])->where(['is_published'=>1]);

        if($category != ""){
            $data->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        }else{
            
            $type =   isset($_GET['type'])?$_GET['type']:"";
            if($type != ''){
                if($type == 'public-services'){
                    $slug =   isset($_GET['slug'])?$_GET['slug']:"";
                    if($slug != ""){
                        $title = __('web.related-doc-to').' '.__('web.'.$type);
                        $data = $data->whereHas('mPublicServices', function($query) use ($slug){
                            $query->whereHas('automation', function($query) use ($slug){
                                $query->where('slug', $slug); 
                            });
                        });
                    }   
                }
            }
            
        }

           

        $data = $data->orderBy('official_published_date', 'DESC')->paginate(10);

       // print_r($data); die;

        $defaultData = $this->defaultData($locale);
        $title = __('web.all-type-of-docs'); 
    	return view('frontend.document.index', 
                [
                    'locale'=>$locale, 
                    'subActive' => $category,
                    'defaultData'=>$defaultData, 
                    'title' => $title,
                    'data' => $data, 
                ]);
       
    }
}
