<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\$module\models\$modulModels;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class $moduleController extends Ozn
{
	public function get$module()
	{
		$modulGet = $modulModels::select(['status',])->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('$module',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function add$moduled()
	{
		$modul = new $modulModels;
		$modul->id = request('');
		if($modul->save())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "$modulModels Success Inserted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "$modulModels Not Success Inserted";
			return $return_arr;
		}
	}

	public function edit$moduled()
	{
		$modul = $modulModels::find(request('id$module'));
		$modul->id = request('');
		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "$modulModels Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "$modulModels Not Success Updated";
			return $return_arr;
		}
	}

	public function update$moduled()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = $modulModels::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="$modulModels Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="$modulModels Status Failed Updated";
			return $return_arr;
		}
	}

	public function delete$moduled()
	{
		$modul = $modulModels::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "$modulModels Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "$modulModels Not Success Deleted";
			return $return_arr;
		}
	}
}
?>