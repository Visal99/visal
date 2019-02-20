<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Automation\Main as PublicService; 
use App\Model\Automation\Location; 
use App\Model\Automation\Faq; 
use App\Model\Documents\Main as Document; 

class PublicServiceController extends FrontendController
{
    public function index($locale = "en", $slug = '') {
    	$data = PublicService::select(
    		'id',
            $locale.'_title_abbre as abbre', 
    		$locale.'_title as title',
    		$locale.'_content as content',
    		$locale.'_more as more',
            'slug',
    		'icon', 
    		'image_url as image', 
    		'video', 
    		'appstore', 
    		'playstore', 
    		'website', 
    		$locale.'_phone as phone', 
    		'email', 
    		$locale.'_working_hour as working_hour'

    	)->where(['slug'=>$slug])->first();

    	if($data){
    		$defaultData = $this->defaultData($locale);
            
    		$documents = Document::select($locale.'_title as title', 'google_drive_url', 'event_date', 'category_id')->with(['category:id,'.$locale.'_name as title,slug'])->whereHas('mPublicServices', function($query) use($data){
               $query->where('automation_id', $data->id); 
            })->where('is_published', 1)->limit(10)->get(); 

    		$locations = Location::select(
                $locale.'_title as title', 
                'phone', 
                'lat',
                'lng',
                $locale.'_address as address', 
                $locale.'_working_hour as working_hour', 
                'google_map_url'
            )->get(); 

            $faqs = Faq::select(
                'id',
                $locale.'_question as question', 
                $locale.'_answer as answer'
            )->where('automation_id', $data->id)->get(); 

            return view('frontend.public-service.index', 
	        	[
	        		'locale'=>$locale, 
                    'subActive' => $data->slug,
	        		'defaultData'=>$defaultData, 
	        		'title' => $data->title, 
	        		'data' => $data, 
	        		'documents' => $documents, 
	        		'locations' => $locations, 
	        		'faqs' => $faqs

	        	]);
    	}else{
    		return view('errors.404');
    	}

       

       
    }
}
