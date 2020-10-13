<?php
use Ozn\Ozn;
use Yajra\Datatables\Facades\Datatables;
use Modules\merchants\models\Merchants;
use Modules\users\models\Users;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
class merchantsController extends Ozn
{
	public function getmerchants()
	{
		$modulGet = Merchants::select(['id_merchant','merchant_name','company_name','activation','logo'])->get();
		
		return Datatables::of($modulGet)
		->addColumn('logo_',function($modulGet)
		{
			return "<img src='".url("public/merchant")."/".$modulGet->logo."' class='img-responsive' />";
		})
		->addColumn('id_merchant_',function($modulGet)
		{
			return $modulGet->id_merchant;
		})
		->addColumn('merchant_name_',function($modulGet)
		{
			return $modulGet->merchant_name;
		})
		->addColumn('company_name_',function($modulGet)
		{
			return $modulGet->company_name;
		})
		->addColumn('action', function ($modulGet) {
			$btndt = "";
			$mCont = New Modules\modules\modulesController;
			//$activation = collection($modulGet->activation);
			$checkedStatus = "checked";
			if(array_key_exists("is_actived",$modulGet->activation))
			{
				$checkedStatus = ($modulGet->activation['is_actived'] == "on")?"checked":"un";
			}else{
				$checkedStatus = "un";
			}
			$modelValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedStatus.'"}';
			return $mCont->getactiondt('merchants',$modelValue);
		})
		->removeColumn('_id')
		->removeColumn('id_merchant')
		->removeColumn('merchant_name')
		->removeColumn('company_name')
		->removeColumn('activation')
		->removeColumn('logo')
		->make();
	}

	public function checkEmail($email)
	{
		$Users = Users::where('email',$email)->count();
		if($Users == 0)
		{
			return 1;
		}else{
			return 0;
		}
	}

	public function addmerchantsd()
	{
		$modul = new Merchants;
		$lastIDMerchant = $modul->count();
		$idMerchant = "QM".sprintf('%05d', ((int) $lastIDMerchant+1));
		$modul->id_merchant = $idMerchant;
		$modul->merchant_name = request('merchant_name');
		$modul->company_name = request('company_name');
		$modul->caption = request('caption');

		$contacts = request('contact_value');
		$contacts_ = $contacts;
		$modul->contacts = $contacts_;

		$address = request('addressi_value');
		$modul->address = $address;

		$activation = request('activation_value');
		$modul->activation = $activation;


		#$modul->extra_information = request('');
		$modul->registration_date = date("Y-m-d",time());
		$checkEmailUsers = $this->checkEmail($contacts['email']);
		if($checkEmailUsers == 1)
		{
			if($modul->save())
			{

				$idMercant = $modul->_id;
				$filelogo = request()->file('file');
				//print_r($filelogo);
				if($filelogo !=""){
					$ext = $filelogo->guessClientExtension();
					$path = $filelogo->storeAs("logo", "merchant_".$idMercant.".".$ext, 'merchant');
					$modul->logo = $path;
					if($modul->update()){
						$return_arr['status'] = 1;
						$return_arr['message'] = "Merchant Success Inserted";
						return $return_arr;
					}else{
						$return_arr['status'] = 0;
						$return_arr['message'] = "Merchant Success Inserted, But Logo Merchant Not Success Uploaded";
						return $return_arr;
					}
				}else{
					$return_arr['status'] = 1;
					$return_arr['message'] = "Merchant Success Inserted";
					return $return_arr;
				}
				
			}else{
				$return_arr['status'] = 0;
				$return_arr['message'] = "Merchant Not Success Inserted";
				return $return_arr;
			}
		}else{
				$return_arr['status'] = 0;
				$return_arr['message'] = "Email Already Registered";
				return $return_arr;
		}
		
	}

	public function editmerchantsd()
	{
		$idMercant = request('idmerchants');
		$modul = Merchants::find($idMercant);
		$modul->merchant_name = request('merchant_name');
		$modul->company_name = request('company_name');
		$modul->caption = request('caption');

		$contacts = request('contact_value');
		$contacts_ = [
			"email"=>$modul->contacts['email'],
			"phone"=>$contacts['phone']
		];
		$modul->contacts = $contacts_;

		$address = request('addressi_value');
		$modul->address = $address;

		$activation = request('activation_value');
		$modul->activation = $activation;
		$filelogo = request()->file('file');
		
		if($filelogo !=""){
			$ext = $filelogo->guessClientExtension();
			$path = $filelogo->storeAs("logo", "merchant_".$idMercant.".".$ext, 'merchant');
			$modul->logo = $path;
		}
		if($modul->update())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Merchants Success Updated";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Merchants Not Success Updated";
			return $return_arr;
		}
	}

	public function updatemerchantsd()
	{
		$idUpdate = explode("-",request('data'));
		$id = Ozn::hashID_decode($idUpdate[0]);
		$modul = Merchants::find($id);
		$status_id = (request('statusid') == 1)?"on":request('statusid');
		$activations = $modul->activation;
		$modul->activation = [
			"is_actived"=>$status_id,
			"activation_date"=>$activations['activation_date'],
			"activation_through" =>$activations['activation_through']
		];
		$return_arr = array();

		if($modul->save()){
			$return_arr["status"]=1;
			$return_arr["message"]="Merchants Status Updated";
			return $return_arr;
		}else{
			$return_arr["status"]=0;
			$return_arr["message"]="Merchants Status Failed Updated";
			return $return_arr;
		}
	}

	public function deletemerchantsd()
	{
		$modul = Merchants::find(request('data'));
		if($modul->delete())
		{
			$return_arr['status'] = 1;
			$return_arr['message'] = "Merchants Success Deleted";
			return $return_arr;
		}else{
			$return_arr['status'] = 0;
			$return_arr['message'] = "Merchants Not Success Deleted";
			return $return_arr;
		}
	}
}
?>