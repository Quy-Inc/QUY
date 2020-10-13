<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\menus\models\Menus;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class menusController extends Ozn
{
	public function getmenus()
	{
		$modulGet = Menus::select(['id_menu','menu_code','menu_name','caption','description','status'])->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('menus',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addmenusd()
	{

		//dd(request());
		$modul = new Menus;
		$lastIDMenus = $modul->count();
		$idMenus = "QPN".sprintf('%05d', ((int) $lastIDMenus+1));

		$modul->id_merchant = request('id_merchant');
		$modul->id_menu = $idMenus;
		$modul->id_category = request('id_category');
		$modul->id_kitchen = request('id_kitchen');
		$modul->menu_code = request('menu_code');
		$modul->menu_name = request('menu_name');
		$modul->caption = request('caption');
		$modul->description = request('description');
		$modul->component = request('component');
		$modul->add_on_alternatives = request('addonalternative');
		$modul->price = request('price');

		$photo = request()->file('file');

		$totalPhoto = count($photo);

		$label = request('labelfile');

		$modul->status = 1;

		if($modul->save())
		{
			// $return_arr['status'] = 1;
			// $return_arr['message'] = "Menus Success Inserted";
			// return $return_arr;

			$idMenuDb = $modul->_id;

			if($totalPhoto > 0)
			{
				foreach ($photo as $key => $value) {

					$label = $label[$key];
					$photoFile = $photo[$key];

					if($photoFile !=""){
						$ext = $photoFile->guessClientExtension();
						$path = $photoFile->storeAs("photo", "menus_".$idMenuDb."_".$key.".".$ext, 'merchant');
						$PhotoUpload[$key] = ['photo'=>$path,'label'=>$label];
					}

				}
				$modul->photos = $PhotoUpload;
				if($modul->update()){
					$return_arr['status'] = 1;
					$return_arr['message'] = "Menu Success Inserted";
					return $return_arr;
				}else{
					$return_arr['status'] = 0;
					$return_arr['message'] = "Menu Success Inserted, But Photo Stores Not Success Uploaded";
					return $return_arr;
				}
			}

		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menus Not Success Inserted";
			return $return_arr;
		}
	}

	public function editmenusd()
	{
		$modul = Menus::find(request('idmenus'));
		
		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Menus Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menus Not Success Updated";
			return $return_arr;
		}
	}

	public function updatemenusd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Menus::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Menus Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Menus Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletemenusd()
	{
		$modul = Menus::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Menus Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menus Not Success Deleted";
			return $return_arr;
		}
	}
}
?>