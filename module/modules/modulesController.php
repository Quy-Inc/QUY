<?
namespace Modules\modules;
use \Ozn\Ozn;
use \Yajra\Datatables\Facades\Datatables;
use \Illuminate\Support\Collection;
use \Illuminate\Support\Facades\Input;
use \Modules\profiles\models\Profiles;
use File;
use Auth;
class modulesController extends Ozn
{

	public function getactiondt($slug,$value){
		$explodeValue = explode("#",$value);
		$module = "module/".$slug."/.conf";
		$content= File::get($module);
		$data_menu = json_decode($content);
		$dtlist = array();
		$dtlistBtn = "";
		$idProfile = Auth::user()->id_profile;
		$i=0;
		if($idProfile == "1"){
			
			
			foreach($data_menu->action as $keys => $values){
				
				
				if($data_menu->action->$keys->dtlist == "1"){
					$iv = $i++;

					
					
					switch($data_menu->action->$keys->type){
					
					case "btn":
						
						$data_var = json_decode($explodeValue[$iv]);
						//$id_encode = Ozn::hashID_encode($data_var->id);
						foreach($data_var as $k =>$value){
							$id_encoded[]=Ozn::hashID_encode($value);
							
						}
						
						$id_encode=join('-',$id_encoded);
						if($id_encode != ""){
							$urlLink = (strpos($data_menu->action->$keys->page, '#') === false)?'href="'.url($data_menu->action->$keys->page,['data'=>$id_encode]).'"':"";
							
							$dtlistBtn .= '<a '.$urlLink.' style="margin-right:8px;" valueajax="'.$id_encode.'" class="btn '.$data_menu->action->$keys->aclass.'"><i class="fa '.$data_menu->action->$keys->iclass.'"></i></a>';
						}
						$id_encode="";
						$id_encoded=array();
					break;
					
					case "checkbox":
						
					$data_var = json_decode($explodeValue[$iv]);
						//$id_encode = Ozn::hashID_encode($data_var->id);
						foreach($data_var as $k =>$value){
							$id_encoded[]=Ozn::hashID_encode($value);
						}
						
						$id_encode=join('-',$id_encoded);
						if($id_encode != ""){

							
							$dtlistBtn .='<div style="float:right; margin-top:5px;" class="iSwitch flat-switch"><div class="switch '.$data_menu->action->$keys->aclass.'"><input type="checkbox" '.$data_var->checked.' valueajax="'.$id_encode.'#'.$data_var->checked.'"></div></div>';
						}
						$id_encode="";
						$id_encoded=array();
					break;
					
					default:
						
						$data_var = json_decode($explodeValue[$iv]);
						//$id_encode = Ozn::hashID_encode($data_var->id);
						foreach($data_var as $k =>$value){
							$id_encoded[]=Ozn::hashID_encode($value);
						}
						
						$id_encode=join('-',$id_encoded);
						if($id_encode != ""){
							$urlLink = (strpos($data_menu->action->$keys->page, '#') === false)?'href="'.url($data_menu->action->$keys->page,['data'=>$id_encode]).'"':"";
						
							$dtlistBtn .= '<a '.$urlLink.' valueajax="'.$id_encode.'" class="btn '.$data_menu->action->$keys->aclass.'"><i class="fa '.$data_menu->action->$keys->iclass.'"></i></a>';
						}
						$id_encode;
						$id_encoded=array();
					break;
					
					}
				}
				
			}
		}else{
			$getProfile =  Profiles::select(['id','name','role_access'])->where("id",$idProfile)->first();

			if(count($getProfile) >0)
			{
				$Profile =  json_decode($getProfile->role_access,true);
				//echo "<pre>"; print_r($Profile); echo "</pre>";
				//echo "<pre>"; print_r($data_menu->action); echo "</pre>";
				//die();
				foreach($data_menu->action as $keys => $values){
					//return "$keys|";
					//echo $keys."<br/>";
					//echo "<pre>"; print_r($data_menu->action->$keys); echo "</pre>"; 
					if($data_menu->action->$keys->dtlist == "1" && array_key_exists($keys,$Profile[$slug])){
						
						//$dtlistBtn .=$keys.'='.$Profile[$slug][$keys]."-x-"; 
						$iv = $i++;
						if($Profile[$slug][$keys] == 1){
							switch($data_menu->action->$keys->type){
							
								case "btn":
							
							$data_var = json_decode($explodeValue[$iv]);
							//$id_encode = Ozn::hashID_encode($data_var->id);
							foreach($data_var as $k =>$value){
								$id_encoded[]=Ozn::hashID_encode($value);
							}
							
							$id_encode=join('-',$id_encoded);
							if($id_encode != ""){
								$urlLink = (strpos($data_menu->action->$keys->page, '#') === false)?'href="'.url($data_menu->action->$keys->page,['data'=>$id_encode]).'"':"";
								
								$dtlistBtn .= '<a '.$urlLink.' style="margin-right:8px;" valueajax="'.$id_encode.'" class="btn '.$data_menu->action->$keys->aclass.'"><i class="fa '.$data_menu->action->$keys->iclass.'"></i></a>';
							}
							$id_encode="";
							$id_encoded=array();
						break;
						
						case "checkbox":
							
						$data_var = json_decode($explodeValue[$iv]);
							//$id_encode = Ozn::hashID_encode($data_var->id);
							foreach($data_var as $k =>$value){
								$id_encoded[]=Ozn::hashID_encode($value);
							}
							
							$id_encode=join('-',$id_encoded);
							if($id_encode != ""){

								
								$dtlistBtn .='<div style="float:right; margin-top:5px;" class="iSwitch flat-switch"><div class="switch '.$data_menu->action->$keys->aclass.'"><input type="checkbox" '.$data_var->checked.' valueajax="'.$id_encode.'#'.$data_var->checked.'"></div></div>';
							}
							$id_encode="";
							$id_encoded=array();
						break;
						
						default:
							
							$data_var = json_decode($explodeValue[$iv]);
							//$id_encode = Ozn::hashID_encode($data_var->id);
							foreach($data_var as $k =>$value){
								$id_encoded[]=Ozn::hashID_encode($value);
							}
							
							$id_encode=join('-',$id_encoded);
							if($id_encode != ""){
								$urlLink = (strpos($data_menu->action->$keys->page, '#') === false)?'href="'.url($data_menu->action->$keys->page,['data'=>$id_encode]).'"':"";
							
								$dtlistBtn .= '<a '.$urlLink.' valueajax="'.$id_encode.'" class="btn '.$data_menu->action->$keys->aclass.'"><i class="fa '.$data_menu->action->$keys->iclass.'"></i></a>';
							}
							$id_encode;
							$id_encoded=array();
						break;
							}
						}	
					}
				}
			}else{
				$dtlistBtn = count($getProfile);
			}
		}
		
		return $dtlistBtn;
		//return $dtlist;
		
	}
}