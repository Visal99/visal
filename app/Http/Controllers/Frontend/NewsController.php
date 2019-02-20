<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;
use App\Model\News\Category; 
use App\Model\News\Main as News; 

class NewsController extends FrontendController
{
    public function index($locale = "en", $category = '') {

    	$title = __('web.recent-posts'); 
        $subActive = '';
        $dataCateogry = Category::select($locale.'_title as title', 'slug')->where('slug', $category)->first();
        if($dataCateogry){
            $title = $dataCateogry->title;
            $subActive = $dataCateogry->slug;
        }
        $data = News::select('id', $locale.'_title as title', $locale.'_content as content', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1]);

        if($category != ""){
            $data->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        }

        $data = $data->orderBy('event_date', 'DESC')->paginate(8);

        $defaultData = $this->defaultData($locale);
    	return view('frontend.news.index', 
                [
                    'locale'=>$locale, 
                    'subActive' => $subActive,
                    'defaultData'=>$defaultData, 
                    'title' => $title,
                    'data' => $data, 
                    'features' => $this->getFeaturedNews($locale)
                ]);
       
    }

    public function detail($locale = "en", $id = 0){


       $data = News::select('id', $locale.'_title as title', $locale.'_content as content', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1, 'id'=>$id])->first();
       if($data){

            $title = $data->title; 
            $subActive = '';
            $dataCategory = Category::select($locale.'_title as title', 'slug')->where('id', $data->category_id)->first();
            if($dataCategory){
                $subActive = $dataCategory->slug;
            }

            $defaultData = $this->defaultData($locale);
            return view('frontend.news.detail', 
                    [
                        'locale'=>$locale, 
                        'subActive' => $subActive,
                        'defaultData'=>$defaultData, 
                        'category' => $dataCategory,
                        'title' => $title,
                        'data' => $data, 
                        'features' => $this->getFeaturedNews($locale, $data->id)
                    ]);
       }else{
            return view('errors.404');
       }
    }

    public function getFeaturedNews($locale = 'en', $currentNewId = 0){
        $data = News::select('id', $locale.'_title as title', $locale.'_content as content', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1, 'is_featured'=>1]); 
        if($currentNewId != 0){
            $data = $data->where('id', '<>', $currentNewId);
        }
        $data = $data->orderBy('featured_updated_at', 'ASC')->limit(5)->get();
        return $data;
    }



    //===================================================>>
    public function posts($locale = "en") {
        $page       =   intval(isset($_GET['page'])?$_GET['page']:1); 
        $tag        =   intval(isset($_GET['tag'])?$_GET['tag']:0);
        $source     =   intval(isset($_GET['source'])?$_GET['source']:0);
        $title      =   isset($_GET['title'])? ': '.$_GET['title']:'';

        $qruery = '';
        if($tag != 0){
            $qruery = '&tag_id='.$tag;
        } 

        if($source != 0){
            $qruery = '&source_id='.$source;
        } 

        $defaultData = $this->defaultData($locale);
        $press = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip?limit=10&page='.$page.$qruery)); 
        $feature = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip?limit=1')); 
        $tags = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip/tags?limit=10')); 
        $sources = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip/sources?limit=10')); 

        //dd($press['data']->data);  die;
        $nextPage = '#'; 
        $prevousPage= '#'; 
        if($press['data']->prev_page_url != null){
            $segment = explode('=', $press['data']->prev_page_url); 
            $prevousPage = route('posts', ['locale'=>$locale]).'?page='.$segment[1]; 
        }

        if($press['data']->next_page_url != null){
            $segment = explode('=', $press['data']->next_page_url); 
            $nextPage = route('posts', ['locale'=>$locale]).'?page='.$segment[1]; 
        }

        
        return view('frontend.news.posts', 
                    [
                        'locale'=>$locale, 
                        'subActive' => '',
                        'defaultData'=>$defaultData, 
                        'title' => 'Press '.$title, 
                        'press' => $press, 
                        'feature' => $feature, 
                        'tags' => $tags,
                        'sources' => $sources,
                        'prevousPage'=>$prevousPage,
                        'nextPage'=>$nextPage, 
                        'source' => $source, 
                        'tag' => $tag
                    ]);
       
    }

    public function post($locale = "en", $id = 0){

        //$data = News::select('id', $locale.'_title as title', $locale.'_content as content', 'event_date', 'category_id')->with(['category:id,slug,'.$locale.'_title as title'])->where(['is_published'=>1, 'id'=>$id])->first();
        $press = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip/'.$id)); 
        if($press['status_code'] != '404'){
            $data = $press['data']; 

            $title = $data->title; 
            $subActive = '';
            $press = (array) json_decode(file_get_contents('http://172.19.24.22:82/news-clip?limit=8')); 
           

            $defaultData = $this->defaultData($locale);
            return view('frontend.news.post', 
                    [
                        'locale'=>$locale, 
                        'subActive' => $subActive,
                        'defaultData'=>$defaultData, 
                        'title' => $title,
                        'data' => $data, 
                        'press' => $press
                    ]);
        }else{
            return view('errors.404');
        }
    }

}
