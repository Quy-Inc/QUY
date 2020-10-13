<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\tables\models\Tables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class tablesController extends Ozn
{
	public function gettables()
	{
		$modulGet = Tables::select([
		'id_table',
		'table_code',
		'table_name',
		'caption',
		'description',
		'status'
		])->get();
		
		return Datatables::of($modulGet)
		
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			$checkedStatus = ($modulGet->status == 1)?"checked":"un";
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('tables',$modelValue);
		})
		->removeColumn('_id')	
		->removeColumn('status')	
		->make();
	}

	public function addtablesd()
	{
		$modul = new Tables;

		$lastIDTables = $modul->count();
		$idTables = "QPT".sprintf('%05d', ((int) $lastIDTables+1));

		$modul->id_table = $idTables;
		$modul->id_merchant = request('id_merchants');
		$modul->id_venues = request('id_venues');
		$modul->table_code = request('table_code');
		$modul->table_name = request('table_name');
		$modul->caption = request('caption');
		$modul->description = request('description');
		$modul->extra_information = request('extra_information');
		$modul->status = 1;

		if($modul->save())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Tables Success Inserted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Tables Not Success Inserted";
			return $return_arr;
		}
	}

	public function edittablesd()
	{
		$modul = Tables::find(request('idtables'));
		$modul->table_code = request('table_code');
		$modul->table_name = request('table_name');
		$modul->caption = request('caption');
		$modul->description = request('description');
		$modul->extra_information = request('extra_information');
		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Tables Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Tables Not Success Updated";
			return $return_arr;
		}
	}

	public function updatetablesd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Tables::find($id);
		$status_id = request('statusid');
		$modul->status = $status_id;
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Tables Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Tables Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletetablesd()
	{
		$modul = Tables::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Tables Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Tables Not Success Deleted";
			return $return_arr;
		}
	}
}
?>