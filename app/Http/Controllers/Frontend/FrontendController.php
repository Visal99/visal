<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Model\Automation\Main as PublicService; 
use App\Model\PublicWork\Main as PublicWork; 
use App\Model\Documents\Category as DocumentCategory; 
use App\Model\News\Category as NewsCategory; 
use App\Model\Contact\Main as Contact; 
use App\Model\Banner\Main as Banner; 
use App\Model\Content\Main as Content; 

class FrontendController extends Controller
{
  	
	public $defaultData = array();
    public function __construct(){
      
    }

    public function defaultData($locale = "kh"){
     
    	App::setLocale($locale);
        $this->defaultData['desktopBanner'] = Banner::find(1)->img_url;
        $this->defaultData['mobileBanner'] = Banner::find(2)->img_url;

    	//=================================================================>> Route
    	$parameters = Route::getCurrentRoute()->parameters();
    	$enRouteParamenters = $parameters;
        $enRouteParamenters['locale'] = 'en';
        $this->defaultData['enRouteParamenters'] = $enRouteParamenters;
        $khRouteParamenters = $parameters;
        $khRouteParamenters['locale'] = 'kh';
        $this->defaultData['khRouteParamenters'] = $khRouteParamenters;
        $this->defaultData['routeName'] = Route::currentRouteName();
        //=================================================================>> Public Service
        $this->defaultData['publicServices'] = PublicService::select('id', $locale.'_title_abbre as abbre', $locale.'_title as title', 'slug', 'icon')->orderBy('data_order', 'ASC')->get();
        //=================================================================>> Public Works
        $this->defaultData['publicWorks'] = PublicWork::select('id', $locale.'_title as title', 'slug')->where(['is_published'=>1])->orderBy('data_order', 'ASC')->get();

        //=================================================================>> News Catetegory
        $data = documentCategory::select('id', $locale.'_name as title', 'slug', 'has_sub')->where('parent_id', null)->orderBy('data_order', 'ASC')->get(); 
        $documentCategories = array();
        foreach($data as $row){
            $item['parent'] = $row; 
            if($row->has_sub == 1){
                $children = documentCategory::select($locale.'_name as title', 'slug')->where('parent_id', $row->id)->get();

                if(count($children) > 0){
                     $item['children'] = $children; 
                }
               
            }
            $documentCategories[] = $item;
            $item = array();
        }
        $this->defaultData['documentCategories'] = $documentCategories;


        //=================================================================>> News Catetegory
        // $data = NewsCategory::select('id', $locale.'_title as title', 'slug', 'has_sub')->where(['parent_id'=> null])->orderBy('data_order', 'ASC')->get(); 
        // $newsCategories = array();
        // foreach($data as $row){
        //     $item['parent'] = $row; 
        //     if($row->has_sub == 1){
        //         $children = NewsCategory::select($locale.'_title as title', 'slug')->where('parent_id', $row->id)->orderBy('data_order', 'ASC')->get();

        //         if(count($children) > 0){
        //              $item['children'] = $children; 
        //         }
               
        //     }
        //     $newsCategories[] = $item;
        //     $item = array();
        // }
        // $this->defaultData['newsCategories'] = $newsCategories;

        //=================================================================>> SEO
        $seo_image = Banner::find(3)->img_url;
        $seo_description = Content::select($locale.'_content as content')->where('slug', 'seo-content')->first()->content;

        $this->defaultData['seo'] = [
            'image' => asset($seo_image), 
            'title' => '', 
            'description' => $seo_description
        ]; 


        //=================================================================>> Contact
        $this->defaultData['contacts'] = Contact::select('id', $locale.'_title as title', 'slug', 'has_sub')->where(['parent_id'=>null, 'is_published'=>1])->orderBy('data_order', 'ASC')->get(); 
        return $this->defaultData;
    }

}
