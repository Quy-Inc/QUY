<?php
namespace Ozn;

use File;
use Illuminate\Support\Collection;
use Modules\users\models\Users;
use Modules\profiles\models\Profiles;
use Auth;
use Request;
class Ozn {

	public function modulesClass($module)
    {
           $class = '\\Modules\\'.$module.'\\'.$module.'Function';
		   return new $class;
    }

	public function getIndexModule($slug,$subslug=0)
	{


	}

	public function getSubMenu($submenu,$menu){
		$men = "";
		foreach($submenu as $smenu => $key){
			//$men .=$smenu."<br />";
			$men .="<li class=\"media\"><div class=\"media-body\"><a href=\"".url("/$menu/$smenu")."\" class=\"media-heading-sub\" style=\"text-decoration:none;     text-transform: capitalize;\"><h5><i class=\"".$key->class_icon."\"/></i> ".$key->name."</h5></a></div></li>";
		}

		return $men;
		//return var_dump($submenu);
	}


	public function getSubMenuIcon($submenu,$menu,$module){

		$men = "";
		foreach($submenu as $smenu => $key){
			if($key->hidden == 0 || !isset($key->hidden))
			{


				$activeMenu = ($module == $smenu)?"active":"";


				$linkMenu = ($key->main == "1")?url("/$menu"):url("/$menu/$smenu");
				$men .=(Ozn::role_access($menu,$smenu) == "1")?"<a href=\"$linkMenu\" class=\"btn ".$key->button_bg." $activeMenu ajax-load\"><i class=\"".$key->class_icon."\"></i> ".$key->name."</a>":"";
				$activeMenu ="";
			}
		}

		return "<div class=\"row\"></div><div class=\"btn-group\">".$men."</div>";

	}

		public function role_access($module,$slug="0"){
			$idProfile = Auth::user()->id_profile;

			$sub_slug = ($slug == "0")?$module:$slug;
			if($idProfile == "1"){
				return "1";
			}else{
				$getProfile =  Profiles::select(['id','name','role_access'])->where("id",$idProfile)->get()->first();
				$Profile =  json_decode($getProfile->role_access,true);
				if($Profile != "" && array_key_exists($module,$Profile)){
					$getAccess = (array_key_exists($sub_slug,$Profile[$module]) && $Profile[$module][$sub_slug] == 1)?1:0;
					return $getAccess;
				}else{
					return "0";
				}
			}
		}


		public function orderasort($array, $key) {
			$sorter=array();
			$ret=array();
			reset($array);
			foreach ($array as $ii => $va) {
				$sorter[$ii]=$va[$key];
			}
			asort($sorter);
			foreach ($sorter as $ii => $va) {
				$ret[$ii]=$array[$ii];
			}
			$array=$ret;
		}


		public function getLeftMenu(){
			$menu = "resources/views/layouts/.menu";
			$content= File::get($menu);
			$data_menu = json_decode($content,true);
			if(Auth::user()->id_profile != "1"){
				$profiles = Profiles::select(['id','name','role_access'])->where("id",Auth::user()->id_profile)->get()->first();
				$profilesUser = json_decode($profiles->role_access,true);
			}else{
				$listDir = File::directories('module/');
				foreach( $listDir as $modules){
					$modul = str_replace("module/","",$modules);
					$module = $modules."/.conf";
					if($modul != "dashboard")
					{
						$content_m= File::get($module);
						$data_menu_ = json_decode($content_m);

						foreach($data_menu_->sub_menu as $keys => $data){
							$profilesUser[$data_menu_->module_slug][$keys] = 1;
						}

						foreach($data_menu_->action as $keys => $data){
							$profilesUser[$data_menu_->module_slug][$keys] = 1;
						}
					}
				}
			}


			//print_r($profilesUser);
			if(count($profilesUser) > 0)
			{
				foreach($profilesUser as $menu => $key){
					$menu_ = "module/".$menu."/.conf";
					//echo $menu_;
					if(File::exists($menu_)){
						$content_= File::get($menu_);
						$contentz = json_decode($content_,true);
						//echo array_key_exists($contentz['sub'],$data_menu)."<br />";

						if(array_key_exists($contentz['sub'],$data_menu) && $data_menu[$contentz['sub']]['sub'] == "1"){
							if(array_key_exists($menu,$profilesUser[$menu]))
							{

								if($profilesUser[$menu][$menu] == "1"){

									$data_menu[$contentz['sub']]['sub_menu'][$menu]['name'] = $contentz['module_name'];
									$data_menu[$contentz['sub']]['sub_menu'][$menu]['order'] = $contentz['order'];
									$data_menu[$contentz['sub']]['sub_menu'][$menu]['slug'] = $menu;
									//echo "x";
								}else{
									//echo "y";
									unset($profilesUser[$menu][$menu]);
								}

								if(array_key_exists('sub_menu',$data_menu[$contentz['sub']]) !=""){
									usort($data_menu[$contentz['sub']]['sub_menu'],function($a,$b){
										return $a['order'] - $b['order'];
									});
								}
							}
						}
					}

				}
			}

			usort($data_menu,function($a,$b){
				return $a['order'] - $b['order'];
			});
			$main_menu ="";
			$li_subMenu = "";
			 foreach($data_menu as $menu_left){



				 if($menu_left['sub']=="1"){
					 if(array_key_exists('sub_menu',$menu_left)){
						 foreach($menu_left['sub_menu'] as $keys => $data){
							 $li_subMenu .= "<li><a href=\"".url("/$data[slug]")."\" class=\"ajax-load\">$data[name]</a></li>";
						 }
						 $li = "1";
					 }else{
						 $li = "0";
					 }
				 }

				 //echo $menu_left['sub'];
				 $idProfileUser = Auth::user()->id_profile;
				 $dashboard = "";
				 if(array_key_exists('dashboard',$menu_left) && $menu_left['dashboard'] == $idProfileUser ){
						$dashboard = "<li><a href=\"".url("/dashboard")."\" class=\"ajax-load\"><i class=\"icon  $menu_left[class_icon]\"></i> $menu_left[name] </a></li>";
				 }

				 $menu_main =(Ozn::role_access($menu_left['slug']) ==1 && (array_key_exists("dashboard",$menu_left) == false))?"<li><a href=\"".url("/$menu_left[slug]")."\" class=\"ajax-load\"><i class=\"icon  $menu_left[class_icon]\"></i> $menu_left[name] </a></li>":"";

				 $main_menu .= ($menu_left['sub']==0)?$menu_main:(($li == 1)?"<li><span><i class=\"icon  fa $menu_left[class_icon]\"></i> $menu_left[name]</span><ul>$li_subMenu</ul></li>":"");

				 $li_subMenu = "";

			 }


			 $dash = ($dashboard=="")?"<li><a href=\"".url("/dashboard")."\" class=\"ajax-load\"><i class=\"icon  fa fa-desktop\"></i> Dashboard </a></li>":"";

			return $dashboard.$dash.$main_menu;
			//echo "<pre>";print_r($dashboard);echo "</pre>";
			//print_r($profilesUser);

		}

	public function hashID_encode($id){
		/*$key =Request::cookie('laravel_session');
		$hashids =  new \Hashids\Hashids($key);
		return $hashids->encode($id);*/
		return $id;
	}

	public function hashID_decode($id){
		/*$key =Request::cookie('laravel_session');
		$hashids =  new \Hashids\Hashids($key);
		return $hashids->decode($id)[0];*/
		return $id;
	}

	public function getIp(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}
	}

}
