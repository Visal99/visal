<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendController;
use App\Model\Website\Main as Website; 
use App\Model\Documents\Main as Document; 
//use App\Model\News\Main as Post;
use App\Model\Greeting\Main as Greeting; 

class HomeController extends FrontendController
{
    public function index($locale = "en") {
        $defaultData = $this->defaultData($locale);
        // $latestFeaturedPost = Post::select('id', $locale.'_title as title', $locale.'_content as content', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1, 'is_featured'=>1])->orderBy('featured_updated_at', 'DESC')->first();
        // $exceptFeaturedPostId = 0;
        // if($latestFeaturedPost){
        // 	$exceptFeaturedPostId = $latestFeaturedPost->id;
        // }
        //$posts = Post::select('id', $locale.'_title as title', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1])->where('id', '<>', $exceptFeaturedPostId)->orderBy('event_date', 'DESC')->limit(6)->get();
        $greeting = Greeting::select('id', $locale.'_title as title', $locale.'_description as description', 'img_url as img', $locale.'_link as link')->where('is_featured', 1)->first();

        $press = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip?limit=10')); 
        //print_r($defaultData); die; 
        return view('frontend.home', [
        	'locale'=>$locale, 
        	'defaultData'=>$defaultData, 
            'greeting'=>$greeting,
        	'websites' => Website::select($locale.'_title as title', 'website', 'img_url as logo')->orderby('data_order', 'ASC')->get(), 
        	'documents' => Document::select('id', $locale.'_title as title', 'google_drive_url','official_published_date','event_date', 'category_id')->with(['category:id,slug,'.$locale.'_name as title'])->where(['is_published'=>1])->orderBy('official_published_date', 'DESC')->limit(10)->get(),
        	//'posts'=>$posts,
        	//'featuredPost'=>$latestFeaturedPost, 
            'press' => $press
        ]);
    }
}
