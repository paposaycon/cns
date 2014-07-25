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

	public function showProfile()
	{
		return View::make('account/profile');
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
				'directupline' => Input::get('direct_upline'),
				'sponsor'   => Input::get('sponsor'),
			);

			$result = User::addUser($userdata);

			return $result;
		}
		else {
			return 'Code entered is Unknown or Already used.';
		}
	}

	public function updateProfile()
	{
		$field = Input::get('field');

		if ($field == 'common') {
			$userdata = array(
				'username' => Input::get('username'),
				'firstname' => Input::get('firstname'),
				'middlename' => Input::get('middlename'),
				'lastname' => Input::get('lastname'),
				'sex' => Input::get('sex'),
			);
			return json_encode(User::updateUser(Auth::user()->id, $userdata));
		}
		if($field == 'password')
		{
			if (Hash::check(Input::get('currentpassword'), Auth::user()->password))
			{
			   $userdata = array('password' => Hash::make(Input::get('newpassword')));
			   return json_encode(User::updateUser(Auth::user()->id, $userdata));
			}
			else
			{
				return 'Current Password is Invalid';
			}
		}
	}

	public function getUsers()
	{
		return json_encode(User::getUsers());
	}

	public function login()
	{
		$userdata1 = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);
		$userdata2 = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);
		
		if (User::login($userdata1))
		{
			return 'verified';
		}
		else
		{
			if (User::login($userdata2))
			{
				return 'verified';
			}
			else
			{
				return 'Either your Username/Email or password is incorrect.';				
			}

		}		
	}

	public function logout()
	{	
		User::logout();
		Session::flush();
		return Redirect::to('/');
	}

}
