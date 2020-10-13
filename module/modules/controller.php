<?

use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Modules\profiles\models\Profiles;
class modulesController extends Ozn
{
	public function getdirectory(){
		$directory = new Collection;
		$i = 1;
        //$faker = Faker::create();

		$listDir = File::directories('module/');
		foreach( $listDir as $modules){
			$modul = str_replace("module/","",$modules);
			if($modul != "dashboard")
			{
				$id = $i++;
				$module = $modules."/.conf";
				$content= File::get($module);
				$data_menu = json_decode($content);
				$directory->push([
					'id'         => $id,
					'module'       => '<i class="'.$data_menu->class_icon.'"></i>  '.$modul,
					'action' => '<a href="#permission-modules-'.$id.'" class="btn btn-warning md-ajax-load" value="'.$modul.'"><i class="fa fa-lock"></i></a>'
				]);
			}

        }

		//print_r($directory);
        return Datatables::of($directory)->make(true);
	}

	public function sendrole(){
		$id = Input::get('idprofile');
		$slugaction = Input::get('slugaction');
		$statusrole = Input::get('statusrole');
		$module = Input::get('module');
		$profiles = Profiles::select(['id','name','role_access'])->where("id",$id)->get()->first();
		$profilesID = $profiles->_id;
		$role_access = $profiles->role_access;
		//dd($role_access);
		$getRole = ($role_access !="") ? json_decode($role_access,true):"0";
		$updateArr = [$module=>[$slugaction=>$statusrole]];
		$updateArr_ = [$slugaction=>$statusrole];

		//dd($getRole);

		if(count($getRole) == 0){
			$updateSlug = json_encode($updateArr,true);
			$uProfile = Profiles::find($profilesID);
			$uProfile->role_access = $updateSlug;
			if($uProfile->save()){
				return json_encode(["status"=>"1","resp"=>"Role $profiles->name Updated!"]);
			}else{
				return json_encode(["status"=>"0","resp"=>"Role $profiles->name Not Updated!"]);
			}
		}else{

			unset($getRole[$module][$slugaction]);
			$getRole[$module][$slugaction] = $statusrole;

			//print_r($getRole);
			$uProfile = Profiles::find($profilesID);
			$uProfile->role_access = json_encode($getRole,true);
			if($uProfile->save()){
				return json_encode(["status"=>"1","resp"=>"Role $profiles->name Updated!"]);
			}else{
				return json_encode(["status"=>"0","resp"=>"Role $profiles->name Not Updated!"]);
			}

			//return print_r($getRole);
			//return json_encode(["status"=>"1","resp"=>"Role $profiles->name X Updated!"]);
		}
	}

	public function vrole_profile(){
		$slug = Input::get("slug");
		return View('modules.view.role_profile')->with("slug",$slug);
	}

	public function getprofilesdata()
    {
		$slug = Input::get("slug");
		$module = getcwd()."/module/".$slug."/.conf";
		// $content= File::get("/");
		$content= File::get($module);

		$data_menu = json_decode($content);

       //return getcwd();
       //die();

		$profiles = Profiles::select(['id','name','role_access'])->where("id","!=","1")->get();

        return Datatables::of($profiles)
		->addColumn('view', function ($profiles) use($data_menu,$slug) {
				$menu = "";
				$role_access = $profiles->role_access;
				$role_access2 =($role_access !="")?json_decode($role_access,true):"";
				foreach($data_menu->sub_menu as $view => $key){

					if($role_access2 != ""){
						if(array_key_exists($slug,$role_access2)){
							if(array_key_exists($view,$role_access2[$slug])){
								$checked = ($role_access2[$slug][$view] == "1")?"checked":"";
							}else{
								$checked = "";
							}
						}else{
							$checked = "";
						}
					}else{
						$checked = "";
					}

					$menu .= '<li s style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;"><input type="checkbox" '.$checked.' name="'.$slug.'-'.$profiles->id.'-'.$view.'"><label>'.$key->name.'</label></li>';
					$checked ="";
				}
                return '<ul class="iCheck role"  data-color="grey">'.$menu.'</ul>';
            })
		->addColumn('action', function ($profiles) use($data_menu,$slug) {
               $action = "";
				$role_access = $profiles->role_access;
				$role_access2 =($role_access !="")?json_decode($role_access,true):"";
				foreach($data_menu->action as $keys => $view){
					if($role_access2 != ""){
						if(array_key_exists($slug,$role_access2)){
							if(array_key_exists($keys,$role_access2[$slug])){
								$checked = ($role_access2[$slug][$keys] == "1")?"checked":"";
							}else{
								$checked = "";
							}
						}else{
							$checked = "";
						}
					}else{
						$checked = "";
					}

					$action .= '<li style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;" ><input type="checkbox" '.$checked.' name="'.$slug.'-'.$profiles->id.'-'.$keys.'"><label>'.$data_menu->action->$keys->name.'</label></li>';
					$checked = "";
				}
                return '<ul class="iCheck role" data-color="blue">'.$action.'</ul>';
            })
		->removeColumn('role_access')
		->removeColumn('_id')
		->removeColumn('id')
		->make();
    }
}
?>
