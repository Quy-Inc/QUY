<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\kitchens\models\Kitchens;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class kitchensController extends Ozn
{
	public function getkitchens()
	{
		$idMerchant = request('id_merchants');
		$modulGet = Kitchens::select(['id_kitchen','kitchen_code','kitchen_name','caption','status'])->where("id_merchant",$idMerchant)->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('kitchens',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addkitchensd()
	{
		$modul = new Kitchens;

		$lastIDKitchens = $modul->count();
		$idKitchens = "QPK".sprintf('%05d', ((int) $lastIDKitchens+1));
		$modul->id_kitchen = $idKitchens;
		$modul->id_merchant = request('id_merchants');
		$modul->kitchen_code = request('kitchen_code');
		$modul->kitchen_name = request('kitchen_name');
		$modul->description = request('description');
		$modul->caption = request('caption');
		$modul->extra_information = request('extra_information');

		if($modul->save())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Kitchens Success Inserted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Kitchens Not Success Inserted";
			return $return_arr;
		}
	}

	public function editkitchensd()
	{
		$modul = Kitchens::find(request('idkitchens'));
		$modul->kitchen_code = request('kitchen_code');
		$modul->kitchen_name = request('kitchen_name');
		$modul->description = request('description');
		$modul->caption = request('caption');
		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Kitchens Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Kitchens Not Success Updated";
			return $return_arr;
		}
	}

	public function updatekitchensd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Kitchens::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Kitchens Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Kitchens Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletekitchensd()
	{
		$modul = Kitchens::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Kitchens Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Kitchens Not Success Deleted";
			return $return_arr;
		}
	}
}
?>