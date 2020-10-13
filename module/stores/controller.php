<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\stores\models\Stores;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class storesController extends Ozn
{
	public function getstores()
	{
		$modulGet = Stores::select(['id_store','store_name','caption','status'])->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('stores',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addstoresd()
	{
		$modul = new Stores;
		$lastIDStores = $modul->count();
		$idStores = "QPS".sprintf('%05d', ((int) $lastIDStores+1));
		$modul->id_venue = request('id_venues');;
		$modul->id_merchant = request('id_merchants');
		$modul->id_store = $idStores;
		$modul->store_name = request('storename');
		$modul->caption = request('storecaption');

		$contacts = request('contact_value');
		$contacts_ = $contacts;
		$modul->contacts = $contacts_;


		$photo = request()->file('file');

		$totalPhoto = count($photo);

		$label = request('labelfile');

		$modul->status = 1;

		if($modul->save())
		{
			$idStoreDb = $modul->_id;

			if($totalPhoto > 0)
			{
				foreach ($photo as $key => $value) {

					$label = $label[$key];
					$photoFile = $photo[$key];

					if($photoFile !=""){
						$ext = $photoFile->guessClientExtension();
						$path = $photoFile->storeAs("photo", "stores_".$idStoreDb."_".$key.".".$ext, 'merchant');
						$PhotoUpload[$key] = ['photo'=>$path,'label'=>$label];
					}

				}
				$modul->photos = $PhotoUpload;
				if($modul->update()){
					$return_arr['status'] = 1;
					$return_arr['message'] = "Stores Success Inserted";
					return $return_arr;
				}else{
					$return_arr['status'] = 0;
					$return_arr['message'] = "Stores Success Inserted, But Logo Stores Not Success Uploaded";
					return $return_arr;
				}
			}
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Stores Not Success Inserted";
			return $return_arr;
		}
	}

	public function editstoresd()
	{
		$id_stores = request('idstores');
		$modul = Stores::find($id_stores);
		$modul->stores_name = request('storename');
		$modul->caption = request('storecaption');

		$contacts = request('contact_value');
		$contacts_ = [
			"email"=>$modul->contacts['email'],
			"phone"=>$contacts['phone']
		];
		$modul->contacts = $contacts_;

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
					$path = $photoFile->storeAs("photo", "stores_".$id_stores."_".$key.".".$ext, 'merchant');
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
			$return_arr['message'] = "Strores Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Strores Not Success Updated";
			return $return_arr;
		}
	}

	public function updatestoresd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Stores::find(request('$id'));
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Stores Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Stores Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletestoresd()
	{
		$modul = Stores::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Stores Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Stores Not Success Deleted";
			return $return_arr;
		}
	}
}
?>