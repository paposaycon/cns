<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function addUser($data) 
	{
		$user = new User;

		foreach ($data as $key => $value) {
			$user->$key = $value;
		}
		
		$user->save();

		return 'The account has been registered.';
	}

	public static function updateUser($id, $data)
	{
		$user = User::find($id);

		foreach ($data as $key => $value) {
			$user->$key = $value;
		}

		return $user->save();
	}

	public static function getUsers()
	{
		$data = false;

		$users = User::all();
		foreach ($users as $user) {
			$data[] = array(
				'id'      => $user['id'],
				'name'    => $user['firstname'] . " " . $user['middlename'] . " " . $user['lastname'],
				'email'   => $user['email'],
			);
		}

		return $data;
	}

	public static function getDownline($id)
	{
		$users = User::where('directupline', '=', $id)->get();

		foreach ($users as $user) {
			$data['lvl1'][] = array(
				'id' => $user->id,
				'name' => $user->firstname . ' ' . $user->lastname,
			);
			// LEVEL 2 MEMBERS
			$lvl2 = User::where('directupline', '=', $user->id)->get();

			foreach ($lvl2 as $user) {
				$data['lvl2'][] = array(
					'id' => $user->id,
					'name' => $user->firstname . ' ' . $user->lastname,
				);

				// LEVEL 3 MEMBERS
				$lvl3 = User::where('directupline', '=', $user->id)->get();

				foreach ($lvl3 as $user) {
					$data['lvl3'][] = array(
						'id' => $user->id,
						'name' => $user->firstname . ' ' . $user->lastname,
					);

					// LEVEL 4 MEMBERS
					$lvl4 = User::where('directupline', '=', $user->id)->get();

					foreach ($lvl4 as $user) {
						$data['lvl4'][] = array(
							'id' => $user->id,
							'name' => $user->firstname . ' ' . $user->lastname,
						);

						// LEVEL 5 MEMBERS
						$lvl5 = User::where('directupline', '=', $user->id)->get();

						foreach ($lvl5 as $user) {
							$data['lvl5'][] = array(
								'id' => $user->id,
								'name' => $user->firstname . ' ' . $user->lastname,
							);
						}

					}

				}

			}
			
		}

		return $data;
	}

	public static function login($data)
	{
		if (Auth::attempt($data))
		{	
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function logout()
	{
		Auth::logout();
		Session::flush();
	}
	
}