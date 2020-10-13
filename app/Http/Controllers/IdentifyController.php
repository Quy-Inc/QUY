<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Ozn;
use File;
use Response;
use App\Location;
use DB;
class IdentifyController extends Controller
{
	
	 public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
    public function index(Request $request,$slug,$subslug=0,$data="")
    {
		
		if($request->ajax() && Ozn::role_access($slug,$subslug) == "1")
			{
				
				$module = "module/".$slug."/.conf";
				//return $module;
				//die();
				if(File::exists($module)){
					$content= File::get($module);
					$data_menu = json_decode($content);
					
					
					$name = $data_menu->module_name;
					//return view('modules.'.$slug.'.app',['name'=>$name,'content'=>$data_menu,'slug'=>$slug,'subslug'=>$subslug]);
					//return $request;
					return view($slug.'.app',['name'=>$name,'content'=>$data_menu,'slug'=>$slug,'subslug'=>$subslug,'data'=>$data]);
						
				}else{
					return view('notfound');
				}
			}else{
				//return abort(403, 'Your Request Unauthorized.');
				return response()->json(['error'=>'Page Not found'],404);
			}
    }
	
	public function getModuleController(Request $request, $slug,$action="",$data=""){
		
		if($request->ajax() && Ozn::role_access($slug,$action) == "1")
			{
			$controller = "module/".$slug."/controller.php";
			if(File::exists($controller)){
				include($controller);
				$contr = $slug."Controller";
				$modcontroller = new $contr;
				if(method_exists("$contr","$action")){
					return $modcontroller->$action();
				}else{
					return "Action Function Not Found";
				}
			}else{
				return "Action Not Found";
			}
		}else{
			return response()->json(['error'=>'Page Not found'],404);
		}

	}
	
	public function postModuleController(Request $request, $slug,$action){
		
		if($request->ajax())
			{
			$controller = "module/".$slug."/controller.php";
			if(File::exists($controller)){
				include($controller);
				$contr = $slug."Controller";
				$modcontroller = new $contr;
				if(method_exists("$contr","$action")){
					return $modcontroller->$action();
				}else{
					return "Action Function Not Found";
				}
			}else{
				return "Action Not Found";
			}
		}else{
			return abort(403, 'Your Request Unauthorized.');
		}

	}	
}
