<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::get('init', 'HomeController@initDatabase');

Route::get('update', 'HomeController@update');

// User Profile
Route::get('user/profile', array('as' => 'profile', 'uses' => 'AccountController@showProfile'));
//Update User Profile
Route::post('user/updateprofile', array('as' => 'updateprofile', 'uses' => 'AccountController@updateProfile'));
// Add user - Registration Route
Route::post('adduser', 'AccountController@addUser');
//Check User
Route::post('getusers', 'AccountController@getUsers');
// Login route
Route::post('login', 'AccountController@login');
// Logout route
Route::post('logout', array('as' => 'logout', 'uses' => 'AccountController@logout'));

#
#
# CODES AREA
#
#
// Activation codes creation
Route::post('generatecodes', 'CodesController@generateCode');
// Show Codes route
Route::post('showcodes', 'CodesController@showCodes');
// Codes Allocation
Route::post('allocatecodes', 'CodesController@allocateCodes');
// Get Allocated codes history
Route::post('getAllocations', 'CodesController@getAllocations');

//Member Tree
Route::post('user/downline', array('as' => 'getdownline', 'uses' => 'MembertreeController@getDownline'));
//Show Member Tree Page
Route::get('user/members', array('as' => 'members', 'uses' => 'MembertreeController@showMemberTree'));