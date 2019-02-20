<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use App\Model\AutomationSystem\AutomationSystem as AutomationSystem;
use App\Model\AutomationManual\AutomationManual as AutomationManual;
use App\Model\Tag\Tag as Tag;


class AutomationSystemsController extends FrontendController
{
   
    public function index($locale = "en", $slug=""){
        $defaultData = $this->defaultData($locale);
        $slugs = array("vehicle-registration", "technical-inspection", "transport-licensing", "driver-license", "cambodia-driving-rules");
        $data = AutomationSystem::select($locale.'_title as title', $locale.'_description as description',$locale.'_more as more','ios_link','android_link','link','image','id', 'frame')->orderBy('data_order','ASC')->where('slug', $slug)->first();
        
        if (count($data) == 1) {
        	$documents = DB::table('documents as d')->select('d.slug', 'd.'.$locale.'_title as title', 'tp.'.$locale.'_title as type', 'pdf', 'd.updated_at','tp.id')
        				->join('document_types as tp', 'tp.id', 'd.type_id')
        				->join('document_tag as d_t', 'd_t.document_id', 'd.id')
        				->join('tags as t', 't.id', 'd_t.tag_id')
        				->where('t.slug', $slug)->get();
        $maps = $data->locations()->select('id', $locale.'_title as title',$locale.'_address as address','phone', 'lat','lng','url')->where('published',1)->get();
        //dd($maps);
        	return view('frontend.automation-systems', ['locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data, 'maps'=>$maps, 'documents'=>$documents]);
        }else{
        	return view('errors.404');
        }
        
    }
}
