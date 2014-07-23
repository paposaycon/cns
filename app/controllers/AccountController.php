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
		return View::make('account/register');
	}

	public function addUser() 
	{	
		$userdata = array(
			'firstname' => Input::get('firstname'),
			'lastname'  => Input::get('lastname'),
			'email'     => Input::get('email'),
			// 'activationcode' =>Input::get('activationcode'),
			'password'  => Hash::make(Input::get('password')),
		);

		$result = User::addUser($userdata);

		return $result;
	}

	public function login()
	{
		$userdata = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);
		if (Auth::attempt($userdata))
		{	

		    return Redirect::to('/');
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

}
