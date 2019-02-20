<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendController;
use App\Model\Content\Main; 
use App\Model\Organization\Main as Chart; 
use App\Model\Biography\Main as Biography; 

class AboutUsController extends FrontendController
{
   
    public function missionAndVision($locale = "en") {
        $defaultData = $this->defaultData($locale);
        return view('frontend.about-us.mission-and-vision', 
        	[
        		'locale'=>$locale, 
        		'defaultData'=>$defaultData, 
        		'subActive'=>'mission-and-vision', 
        		'background'=>Main::select($locale.'_content as content')->where('slug', 'background')->first()->content, 
        		'mission' => Main::select($locale.'_content as content')->where('slug', 'mission')->first()->content,
        		'vision' => Main::select($locale.'_content as content')->where('slug', 'vision')->first()->content

        	]);
    }

    public function theSeniorMinister($locale = "en") {

        $data = Biography::select($locale.'_content as content', $locale.'_title as title')->orderBy('data_order', 'ASC')->get();

        $defaultData = $this->defaultData($locale);
        return view('frontend.about-us.the-senior-minister', 
        	[
        		'locale'=>$locale, 
        		'defaultData'=>$defaultData, 
        		'subActive'=>'the-senior-minister', 
        		'data'=>$data
        	]);
    }

    public function messageFromMinister($locale = "en") {
        $defaultData = $this->defaultData($locale);

        return view('frontend.about-us.message-from-minister', 
        	[
        		'locale'=>$locale, 
        		'defaultData'=>$defaultData, 
        		'subActive'=>'message-from-minister', 
        		'content'=>Main::select($locale.'_content as content')->where('slug', 'message-from-minister')->first()->content
        	]);
    }

    public function orgainizationChart($locale = "en") {
        $defaultData = $this->defaultData($locale);
        $data = Chart::select($locale.'_link as link', $locale.'_img_url as img')->first(); 
        return view('frontend.about-us.organization-chart', 
        	[
        		'locale'=>$locale, 
        		'defaultData'=>$defaultData, 
        		'subActive'=>'organization-chart', 
        		'image'=>$data->img, 
                'link' => $data->link
        	]);
    }

}
