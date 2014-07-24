<?php

class AccountController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Account Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'AccountController@showRegister');
	|
	*/

	public function showRegister()
	{
		Auth::logout();
		Session::flush();
		return View::make('account/register');
	}

	public function addUser() 
	{	
		$codevalidation = Codes::validateCode(Input::get('activationcode'));

		if($codevalidation != false){

			foreach ($codevalidation as $codeinfo) {
				$membertype = $codeinfo['membertype'];
				$sponsor_id = $codeinfo['sponsor'];
				$code_id    = $codeinfo['code_id'];
			}

			$codeupdate = Codes::updateCode($code_id, 'used');

			$codedata = array(
				'status' => 1,
			);
			$userdata = array(
				'membertype'=> $membertype,
				'firstname' => Input::get('firstname'),
				'lastname'  => Input::get('lastname'),
				'email'     => Input::get('email'),
				'password'  => Hash::make(Input::get('password')),
			);

			$result = User::addUser($userdata);

			return $result;
		}
		else {
			return 'fail';
		}
	}

	public function login()
	{
		$userdata = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);
		
		if (User::login($userdata))
		{
			return 'verified';
		}		
	}

	public function logout()
	{	
		User::logout();
		return 'success';
	}

}
