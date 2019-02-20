<?php



namespace App\Http\Controllers\Frontend;



use Illuminate\Http\Request;

use App\Http\Controllers\Frontend\FrontendController;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\DB;

use App\Model\DocumentCategory\DocumentCategory as DocumentCategory;

use App\Model\DocumentType\DocumentType as DocumentType;

use App\Model\Document\Document as Document;



class LawsAndRegulationsController extends FrontendController

{

    public function index($locale = "en", $category=""){

        if($category==""){

            $defaultData = $this->defaultData($locale);

            ($defaultData['partnerships']);



            $categories = DocumentCategory::select($locale.'_title as title','id')->get();



            $types = DocumentType::select($locale.'_title as title','id')->get();



            $data = DocumentCategory::select($locale . '_title as title', 'id', 'slug')->first();



            $all = true;



            $documents = DB::table('documents')->select('documents.'.$locale . '_title as title', 'document_categories.'.$locale . '_title as ctitle' ,'pdf','google_link', 'documents.created_at as created_at')

                ->join('document_categories','document_categories.id','=','documents.category_id')->orderBy('id','DESC')->paginate(6);



            return view('frontend.laws-and-regulations', ['category'=>$category,'locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data,'documents'=>$documents,'categories'=>$categories,'types'=>$types, 'all'=>$all]);



        }else{

            $defaultData = $this->defaultData($locale);

            $categories = DocumentCategory::select($locale.'_title as title','id')->get();

            $types = DocumentType::select($locale.'_title as title','id')->get();

            $data = DocumentCategory::where('slug', $category)->select($locale.'_title as title','id','slug')->first();

            $page_name = $data->title;

            $documents = $data->documents()->select($locale.'_title as title','pdf','google_link','created_at')->orderBy('id','DESC')->paginate(6);

            return view('frontend.laws-and-regulations', ['page_name'=>$page_name,'locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data,'documents'=>$documents,'categories'=>$categories,'types'=>$types]);

        }

    }

    public function officialDocument($locale = "en"){
        $defaultData = $this->defaultData($locale);
            $document_types = DocumentType::select($locale.'_title as title','id','slug')->get();
           $documents = Document::select($locale.'_title as title','pdf','google_link','created_at','type_id')->orderBy('id','DESC')->paginate(6);

            return view('frontend.official-document', ['locale'=>$locale,'defaultData'=>$defaultData,'documents'=>$documents,'document_types'=>$document_types]);
    }



    public function search($locale = "en"){

        $defaultData = $this->defaultData($locale);

        $name          = isset($_GET['name'])?$_GET['name']:"";

        $category       =isset($_GET['category']) ? $_GET['category'] : 0;

        $type       =isset($_GET['type']) ? $_GET['type'] : 0;

        $limit          = isset($_GET['limit'])?$_GET['limit']:10;

        if(!is_numeric($limit)){ $limit = 10;}



         $data = DB::table('documents as d')

                ->join('document_categories as c', 'c.id', '=', 'd.category_id')

                ->join('document_types as t', 't.id', '=', 'd.type_id')

                ->select('d.'.$locale.'_title as title','c.'.$locale.'_title as category','t.'.$locale.'_title as type','d.pdf','d.created_at')->orderBy('d.id', 'DESC');



        if($name != ""){

           

            $data = $data->where('d.en_title', 'like', '%'.$name.'%')->orWhere('d.kh_title', 'like', '%'.$name.'%');

        }



        if($category != 0){

            $data = $data->where('d.category_id', $category );

        }



        if($type != 0){

            $data = $data->where('d.type_id', $type );

        }

        $data = $data->paginate($limit);

        

        $categories = DocumentCategory::select($locale.'_title as title','id')->get();

        $types = DocumentType::select($locale.'_title as title','id')->get();



         return view('frontend.search-laws-and-regulations', ['locale'=>$locale,'defaultData'=>$defaultData,'data'=>$data,'categories'=>$categories,'types'=>$types]);

    }

}



