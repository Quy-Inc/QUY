<?

use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\users\models\Users;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class usersController extends Ozn
{

	public function getuserdata()
    {
        $users = Users::select(['id','name','email','status'])->where("id","!=",Auth::user()->id)->get();

        return Datatables::of($users)
		->addColumn('action', function ($user) {

				$btndt = "";
				$mCont = New Modules\modules\modulesController;
				$checkedUser = ($user->status == 1)?"checked":"un";
				$usersValue = '{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":"'.$user->id.'","checked":"'.$checkedUser.'"}';
				return $mCont->getactiondt('users',$usersValue);

                //return '<a href="#edit-'.$user->id.'" class="btn btn-info"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a href="#delete-'.$user->id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
		->removeColumn('status')
		->removeColumn('_id')
		->make();
    }

	public function getusersinfo(){
		if(Input::has('username')){
			$fieldWhere = "username";
			$fieldWhereIs = Input::get('username');
		}else if(Input::has('email')){
			$fieldWhere = "email";
			$fieldWhereIs = Input::get('email');
		}else{
			$fieldWhere = "id";
			$fieldWhereIs = "1";
		}
		if(Input::has('update')){
			$id = Ozn::hashID_decode(Input::get('update'));
			$chkUser = Users::where("$fieldWhere","!=","$fieldWhereIs")->where('id',"==",$id)->get()->first();
		}else{
			$chkUser = Users::where("$fieldWhere","=","$fieldWhereIs")->get()->first();
		}

		if($chkUser->count() > 0){
			return response("false", 200)->header('Content-Type', 'text/plain');
		}else{
			return response("true", 200)->header('Content-Type', 'text/plain');
		}
	}

	public function addusersdata(){
		$userAdd = new Users;
		$userAdd->name = Input::get('name');
		$userAdd->username = Input::get('username');
		$userAdd->email = Input::get('email');
		$userAdd->password = bcrypt(Input::get('password'));
		$userAdd->id_profile = Input::get('profile');
		$userAdd->address = "";
		$userAdd->phone = 0;
		$userAdd->status = 1;
		$return_arr = array();
		if($userAdd->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="User Inserted";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="User Failed Inserted";
			return $return_arr;
		}
	}


	public function editusersdata(){
		$id = Ozn::hashID_decode(Input::get('update'));
		$users = Users::find($id);
		$users->name = Input::get('name');
		if(Input::has('password')){
			$users->password = bcrypt(Input::get('password'));
		}
		if(Auth::user()->id_profile == 1 || Auth::user()->id_profile == 2)
		{
			$users->username = Input::get('username');
			$users->email = Input::get('email');
			$users->id_profile = Input::get('profile');
		}
		$return_arr = array();
		if($users->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="User Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="User Failed Updated";
			return $return_arr;
		}
	}


	public function updatestatususersdata(){
		$idUpdate = explode("-",Input::get('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$users = Users::find($id);
		$status_id = request('statusid');
		$users->status = $status_id;
		$return_arr = array();

		if($users->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="User Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="User Status Failed Updated";
			return $return_arr;
		}
	}

	public function deleteusersdata(){
		$id= request('data');
		$users = Users::find($id);
		if($users->delete()){
			$return_arr["status"]=1;
			$return_arr["message"]="Users Deleted";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Users Not Deleted";
			return $return_arr;
		}
	}

}
?>
