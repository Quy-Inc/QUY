<?
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\profiles\models\Profiles;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class profilesController extends Ozn
{

	public function getprofilesdata()
    {
      $profiles = Profiles::select(['name','status'])->get();
      return Datatables::of($profiles)

		->addColumn('action', function ($profiles) {
				$btndt = "";
				$mCont = New Modules\modules\modulesController;
				$checkedProfile = ($profiles->status == 1)?"checked":"un";
				$profileValue = '{"id":"'.$profiles->id.'"}#{"id":"'.$profiles->id.'"}#{"id":"'.$profiles->id.'","checked":"'.$checkedProfile.'"}';
				return $mCont->getactiondt('profiles',$profileValue);
            })
		->removeColumn('status')
		->removeColumn('_id')
		->make();
    }

	public function addprofilesdata(){
		$profile = new Profiles;
		$profile->name = Input::get('name');
		$profile->status = 1;
		$profile->id = request('idprofile');
		$profile->role_access = "{}";
		$return_arr = array();
		if($profile->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Profile Inserted";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Profile Failed Inserted";
			return $return_arr;
		}
	}

	public function editprofilesdata(){
		$id = Ozn::hashID_decode(Input::get('data'));
		$profile = Profiles::find($id);
		$profile->name = Input::get('name');
		$profile->id = request('idprofile');
		$return_arr = array();
		if($profile->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Profile Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Profile Failed Updated";
			return $return_arr;
		}
	}

	public function deleteprofiledata(){
		$id = Ozn::hashID_decode(Input::get('data'));
		$profile = Profiles::find($id);
		$return_arr = array();
		if($profile->delete()){
			$return_arr["status"]=1;
			$return_arr["message"]="Profile Deleted";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Profile Failed Deleted";
			return $return_arr;
		}
	}

	public function updatestatusprofiledata(){
		$expData = explode("#",Input::get('data'));
		$id = Ozn::hashID_decode($expData[0]);
		$profile = Profiles::find($id);
		$profile->status = (Input::get('statusid'));
		$return_arr = array();
		if($profile->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Profile Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Profile Status Failed Updated";
			return $return_arr;
		}
	}

}
?>
