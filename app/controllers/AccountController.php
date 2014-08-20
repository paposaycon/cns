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
		return View::make('account/profile', array(
			'page_title' => 'Profile',

		));
	}

	public function addUser() 
	{	
		//PREPARING AND VALIDATING DATA FOR ENTRY
		$data_validator = Validator::make(
		    array(
		    	'username'  => Input::get('username'),
		        'firstname' =>  Input::get('firstname'),
		        'lastname'  => Input::get('lastname'),
		        'password'  => Input::get('password'),
		        // 'email'     => Input::get('username'), //Temporary - need to change to email
		        'directupline' => Input::get('direct_upline'),
				'sponsor'   => Input::get('sponsor'),
		    ),
		    array(
		        'username'  => 'required|min:4|unique:users,username',
		        'firstname' => 'required|min:2',
		        'lastname'  => 'required|min:2',
		        'password'  => 'required|min:8',
		        // 'email'     => 'required|email|unique:users',
		        'directupline' => 'required',
		        'sponsor'   => 'required',
		    )
		);

		if ($data_validator->fails())
		{
		    $messages = $data_validator->messages();
		    $error = '';
		    foreach ($messages->all() as $message)
			{
			    $error .= $message . '<br>';
			}
			return $error;
			exit;
		}
		
		// Code validation
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

			$position = (int)User::checkPosition(Input::get('direct_upline'));

			if ($position >= 2) {
				return 'Direct Upline(' .  Config::get('mlm_config.id_prefix') . Input::get('direct_upline') . ') already has the "left" and "right" member. Please select a different upline.';
				exit;
			}
			if ($position < 2) {
				$position = $position + 1;
			}

			$userdata = array(
				'membertype'=> $membertype,
				'username'  => Input::get('username'),
				'firstname' => Input::get('firstname'),
				'lastname'  => Input::get('lastname'),
				'email'     => Input::get('username'), //Temporary - need to change to email
				'password'  => Hash::make(Input::get('password')),
				'directupline' => Input::get('direct_upline'),
				'sponsor'   => Input::get('sponsor'),
				'position'  => $position,
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

			$input['username'] = Input::get('username');

			// Must not already exist in the `email` column of `users` table
			$rules = array('username' => 'unique:users,username');

			$validator = Validator::make($input, $rules);

			if ($validator->fails()) 
			{
			    return 'Username already exists.';
			}
			else
			{
				return json_encode(User::updateUser(Auth::user()->id, $userdata));
			}
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

		return 'Logged out';
	}

}
