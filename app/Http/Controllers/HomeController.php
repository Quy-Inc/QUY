<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use File;
use Ozn;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app');
    }
	
	public function dash()
    {
		
		$module = "resources/views/layouts/.menu";
		if(File::exists($module)){
			$content= File::get($module);
			$data_menu = json_decode($content);
			//return "sasdasd";
			
			foreach($data_menu as $datam){
				 if(array_key_exists('dashboard',$datam))
				 {
					 $profileid =  Auth::user()->id_profile;
					 $name = $datam->name;
					 $slug = $datam->slug;
					 $subslug = 0;
					 //$data = Input::all();
					 //$viw = 'dashboard.'.$datam->slug;
					 //dd($viw);
					 
					 foreach ($datam->dashboard as $key => $value) {
					 	//echo $key."   ".$value."<br/>";
					 	if($key == $profileid){
					 		$viw = "dashboard.".$value;
					 	}
					 }
					 //dd($viw);
					 return view($viw);
					 exit();

					 /*if($datam->dashboard == $profileid){
						
									
							return view($viw);
						    exit();
					 }*/
				 }else{
					 return view('layouts.dashboard');
				 } 
			}
		}
		
    }	
	
	
}
