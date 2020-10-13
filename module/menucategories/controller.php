<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\menucategories\models\Menucategories;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class menucategoriesController extends Ozn
{
	public function getmenucategories()
	{
		$modulGet = Menucategories::select(['id_category','category_name','caption','status',])->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('menucategories',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addmenucategoriesd()
	{
		
		$modul = new Menucategories;
		$lastIDMenuCategories = $modul->count();
		$idMenuCategories = "QPC".sprintf('%05d', ((int) $lastIDMenuCategories+1));
		$modul->id_merchant = request('id_merchant');
		$modul->id_category = $idMenuCategories;
		$modul->category_name = request('category_name');
		$modul->caption = request('caption');
		$modul->description = request('description');
		$modul->extra_information = request('extra_information');


		$photo = request()->file('file');

		$totalPhoto = count($photo);

		$label = request('labelfile');

		$modul->status = 1;

		if($modul->save())
		{
			$idCategoryDb = $modul->_id;

			if($totalPhoto > 0)
			{
				foreach ($photo as $key => $value) {

					$label = $label[$key];
					$photoFile = $photo[$key];

					if($photoFile !=""){
						$ext = $photoFile->guessClientExtension();
						$path = $photoFile->storeAs("photo", "categories_".$idCategoryDb."_".$key.".".$ext, 'merchant');
						$PhotoUpload[$key] = ['photo'=>$path,'label'=>$label];
					}

				}
				$modul->photos = $PhotoUpload;
				if($modul->update()){
					$return_arr['status'] = 1;
					$return_arr['message'] = "Menu Categories Success Inserted";
					return $return_arr;
				}else{
					$return_arr['status'] = 0;
					$return_arr['message'] = "Menu Categories Success Inserted, But Logo MenuCategories Not Success Uploaded";
					return $return_arr;
				}
			}
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menu Categories Not Success Inserted";
			return $return_arr;
		}
	}

	public function editmenucategoriesd()
	{
		$modul = Menucategories::find(request('idmenucategories'));
		$modul->category_name = request('category_name');
		$modul->caption = request('caption');
		$modul->description = request('description');
		$modul->extra_information = request('extra_information');

		$photo = request()->file('file');
		$totalPhoto = (!empty($photo))?count($photo):0;

		
		$label = request('labelfile');
		$totalLabel = count($label);

		if($totalPhoto > 0)
		{
			if(count($modul->photos) > 0)
			{
				foreach($modul->photos as $keypdb => $valuepdb){
					$PhotoUpload[$keypdb] = ['photo'=>$modul->photos[$keypdb]['photo'],'label'=>$modul->photos[$keypdb]['label']];
				}
			}

			foreach ($photo as $key => $value) {
				$labelPhoto = $label[$key];
				$photoFile = $photo[$key];

				if($photoFile !=""){
					$ext = $photoFile->guessClientExtension();
					$path = $photoFile->storeAs("photo", "categories_".$id_stores."_".$key.".".$ext, 'merchant');
					$PhotoUpload[$key] = ['photo'=>$path,'label'=>$labelPhoto];
				}

			}
		}
		
		if($totalLabel > 0 && $totalPhoto == 0)
		{
			foreach ($label as $key => $value) {

				$labelPhoto = $label[$key];
				$photoFile = $modul->photos[$key]['photo'];
				$PhotoUpload[$key] = ['photo'=>$photoFile,'label'=>$labelPhoto];

			}
		}

		$modul->photos = $PhotoUpload;

		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Menucategories Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menucategories Not Success Updated";
			return $return_arr;
		}
	}

	public function updatemenucategoriesd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Menucategories::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Menucategories Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Menucategories Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletemenucategoriesd()
	{
		$modul = Menucategories::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Menucategories Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Menucategories Not Success Deleted";
			return $return_arr;
		}
	}
}
?>