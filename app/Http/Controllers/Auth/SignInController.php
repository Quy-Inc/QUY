<?php namespace App\Http\Controllers\Auth;
use Auth;
use Closure;
use Redirect;
use View;
use Illuminate\Support\Facades\Input;
use Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use App\Http\Controllers\Controller;
class SignInController extends Controller {
	
	
	public function login(Request $request)
	{
		//$redirTo = property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
		$redirTo = redirect()->intended();
		$return_arr = array();
		//$return_arr['redir'] = $redirTo;
		$this->validate($request, [
			'email' => 'required', 'password' => 'required',
		]);
		
		$data = Input::all();
		$pass = md5($data['password']);
		$credentials = array(
				'email'=>$data['email'],
				'password' => $data['password']
				);
		
		if(Auth::attempt($credentials)){
				$return_arr["status"]=1;
				$return_arr["redir"]="home";				
		}else{
				//$return_arr["status"]=0;
				
			$user = User::where('email','=',$data['email'])->first();
			if(isset($user)) {
				if($user->password == md5($data['password'])) { // If their password is still MD5
					$user->password = Hash::make($data['password']); // Convert to new format
					$user->save();
					if(Auth::attempt($credentials)){
						$return_arr["status"]=1;
						$return_arr["redir"]="home";
					}else{
						$return_arr["status"]=0;
						$return_arr["redir"]="login";
					}
				}else{
					// Redirect to the login page.
					//return Redirect::to('login')->withErrors(array('password' => 'Password invalid'))->withInput(Input::except('password'));
					$return_arr["status"]=0;
					$return_arr["redir"]="login";
				}
			}else{
					$return_arr["status"]=0;
					$return_arr["redir"]="login";
			}
					
		}
		return json_encode($return_arr); // return value 
	}

}
