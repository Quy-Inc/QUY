<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\venues\models\Venues;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class venuesController extends Ozn
{
	public function getvenues()
	{
		$idMerchant = request('id_merchants');
		$modulGet = Venues::select(['id_venues','venues_name','caption','status'])->where('id_merchant',$idMerchant)->get();
		
		return Datatables::of($modulGet)
	
		->addColumn('action', function ($modulGet)use($idMerchant) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('venues',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addvenuesd()
	{
		$modul = new Venues;
		$lastIDVenues = $modul->count();
		$idVenues = "QPV".sprintf('%05d', ((int) $lastIDVenues+1));
		$modul->id_venues = $idVenues;
		$modul->id_merchant = request('id_merchants');
		$modul->venues_name = request('venuename');
		$modul->caption = request('venuecaption');

		$contacts = request('contact_value');
		$contacts_ = $contacts;
		$modul->contacts = $contacts_;

		$address = request('addressi_value');
		$modul->address = $address;

		$photo = request()->file('file');

		$totalPhoto = count($photo);

		$label = request('labelfile');

		$modul->status = 1;

		if($modul->save())
		{
			$idVenuesDb = $modul->_id;

			if($totalPhoto > 0)
			{
				foreach ($photo as $key => $value) {

					$label = $label[$key];
					$photoFile = $photo[$key];

					if($photoFile !=""){
						$ext = $photoFile->guessClientExtension();
						$path = $photoFile->storeAs("photo", "venues_".$idVenuesDb."_".$key.".".$ext, 'merchant');
						$PhotoUpload[$key] = ['photo'=>$path,'label'=>$label];
					}

				}
				$modul->photos = $PhotoUpload;
				if($modul->update()){
					$return_arr['status'] = 1;
					$return_arr['message'] = "Venues Success Inserted";
					return $return_arr;
				}else{
					$return_arr['status'] = 0;
					$return_arr['message'] = "Venues Success Inserted, But Logo Venues Not Success Uploaded";
					return $return_arr;
				}
			}
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Venues Not Success Inserted";
			return $return_arr;
		}
	}

	public function editvenuesd()
	{
		$id_venues = request('idvenues');
		$modul = Venues::find($id_venues);
		$modul->venues_name = request('venuename');
		$modul->caption = request('venuecaption');

		$contacts = request('contact_value');
		$contacts_ = [
			"email"=>$modul->contacts['email'],
			"phone"=>$contacts['phone']
		];
		$modul->contacts = $contacts_;

		$address = request('addressi_value');
		$modul->address = $address;

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
					$path = $photoFile->storeAs("photo", "venues_".$id_venues."_".$key.".".$ext, 'merchant');
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
			$return_arr['message'] = "Venues Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Venues Not Success Updated";
			return $return_arr;
		}
	}

	public function updatevenuesd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Venues::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Venues Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Venues Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletevenuesd()
	{
		$modul = Venues::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Venues Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Venues Not Success Deleted";
			return $return_arr;
		}
	}
}
?>
