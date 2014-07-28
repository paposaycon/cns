<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showHome');
	|
	*/

	public function showHome()
	{	
		if (Auth::check()) 
		{ 
			$membertype = Auth::user()->membertype; 
		}
		else
		{
			$membertype = 'guest';
		}

		return View::make('common/home', array(
			'membertype' =>  $membertype,
		));
	}


// Temporary code
	public function initDatabase()
	{
		return View::make('common/home', array(
			'db_result' => Initialize::makeTables(),
		));
	}
	
	public function update()
	{
		return View::make('common/home', array(
			'db_result' => Initialize::updateTables(),
		));
	}
}
