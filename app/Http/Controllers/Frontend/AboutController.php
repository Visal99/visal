<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Content\Contents as Content;
use App\Model\Organization\Organization;
class AboutController extends FrontendController
{
     public function index($locale = "en", $slug=""){
        $slugs = array("background", "mission-and-vision", "minister", "leader", "organization-chart", "achievement");
        $defaultData = $this->defaultData($locale);
        

        if($slug == "minister"){
        	$data['biography'] = Content::select($locale.'_content as content','id', 'image')->where('slug', 'minister-biography')->first();
            $data['education'] = Content::select($locale.'_content as content','id')->where('slug', 'minister-education')->first();
            $data['experience'] = Content::select($locale.'_content as content','id')->where('slug', 'minister-experience')->first();
            $data['politic'] = Content::select($locale.'_content as content','id')->where('slug', 'minister-politic')->first();
            $data['activities'] = Content::select($locale.'_content as content','id')->where('slug', 'minister-activities')->first();
            $data['challenges'] = Content::select($locale.'_content as content','id')->where('slug', 'minister-challenges')->first();
            
            return view('frontend.minister', ['locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data]);
        }else{
            $background = Content::select($locale.'_content as content','id')->where('slug', 'background')->first();
        	$mission = Content::select($locale.'_content as content','id')->where('slug', 'mission')->first();
            $vision = Content::select($locale.'_content as content','id')->where('slug', 'vision')->first();
            return view('frontend.about-us', ['category'=>$slug,'locale'=>$locale,'defaultData'=>$defaultData,'mission'=>$mission,'vision'=>$vision,'background'=>$background]);
        } 
        
    }
    public function organization($locale = "en"){
        $defaultData = $this->defaultData($locale);
            $organization = Organization::select($locale.'_link as link',$locale.'_image as image','id')->first();
            return view('frontend.organization', ['locale'=>$locale,'defaultData'=>$defaultData,'organization'=>$organization]);
        }
}
