<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use App\Model\Press\Press as Press;
use App\Model\PressCategory\PressCategory as PressCategory;

class PressController extends FrontendController
{

    public function index($locale = "en", $category=''){
        $defaultData = $this->defaultData($locale);
        $presses = array();
        if($category != ""){
            $PressCategory = PressCategory::where('slug', $category)->first();
            $presses = $PressCategory->presses()->select($locale.'_title as title',$locale.'_description as description','image','slug','updated_at','feature_image')->orderBy('id','DESC')->paginate(6);
        }else{
            $presses = Press::select($locale.'_title as title',$locale.'_description as description','image','slug','updated_at','feature_image')->orderBy('id','DESC')->paginate(6);
        }

        return view('frontend.press', ['locale'=>$locale,'category'=>$category,'defaultData'=>$defaultData,'presses'=>$presses]);
    }

    public function news($locale = "en"){
        $defaultData = $this->defaultData($locale);
        
            $presses = Press::select($locale.'_title as title',$locale.'_description as description','feature_image','category_id','slug','updated_at')->orderBy('id','DESC')->paginate(6);

        return view('frontend.news', ['locale'=>$locale,'defaultData'=>$defaultData,'presses'=>$presses]);
    }

    public function view($locale = "en",$category="", $slug=""){
        $defaultData = $this->defaultData($locale);
        $data = Press::select($locale.'_title as title',$locale.'_content as content','image','feature_image','slug','updated_at')->where('slug', $slug)->first();
        if($data != ""){
            return view('frontend.press-view', ['locale'=>$locale,'category'=>$category,'defaultData'=>$defaultData, 'data'=>$data]);
        }else{
            return '404';
        }
        
    }
}
