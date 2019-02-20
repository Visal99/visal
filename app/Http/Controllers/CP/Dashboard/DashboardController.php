<?php

namespace App\Http\Controllers\CP\Dashboard;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Dashboard\Main as Model;
use Image;
class DashboardController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.dashboard";
    }

    public function index(){
        
        return view($this->route.'.index', ['route'=>$this->route]);
    }

       
       
   
    
}
