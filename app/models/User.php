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

	public static function checkPosition($id)
	{
		$position = DB::table('users')->where('directupline', '=', $id)->max('position');

		return $position;
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

	public static function getDownline($id, $position)
	{
		$downline = User::where('directupline', '=', $id)->where('position', '=', $position)->get();

		return $downline;
	}

	// This is the Unilevel downline
	public static function getDownline_delegated($id)
	{
		$users = User::where('directupline', '=', $id)->get();

		foreach ($users as $user) {
			$data['lvl1'][] = array(
				'id' => $user->id,
				'name' => $user->firstname . ' ' . $user->lastname,
				'pointvalue' => $user->pointvalue,
				'position' => $user->position,
			);
			// LEVEL 2 MEMBERS
			$lvl2 = User::where('directupline', '=', $user->id)->get();

			foreach ($lvl2 as $user) {
				$data['lvl2'][] = array(
					'id' => $user->id,
					'name' => $user->firstname . ' ' . $user->lastname,
					'pointvalue' => $user->pointvalue,
					'position' => $user->position,
				);

				// LEVEL 3 MEMBERS
				$lvl3 = User::where('directupline', '=', $user->id)->get();

				foreach ($lvl3 as $user) {
					$data['lvl3'][] = array(
						'id' => $user->id,
						'name' => $user->firstname . ' ' . $user->lastname,
						'pointvalue' => $user->pointvalue,
						'position' => $user->position,
					);

					// LEVEL 4 MEMBERS
					$lvl4 = User::where('directupline', '=', $user->id)->get();

					foreach ($lvl4 as $user) {
						$data['lvl4'][] = array(
							'id' => $user->id,
							'name' => $user->firstname . ' ' . $user->lastname,
							'pointvalue' => $user->pointvalue,
							'position' => $user->position,
						);

						// LEVEL 5 MEMBERS
						$lvl5 = User::where('directupline', '=', $user->id)->get();

						foreach ($lvl5 as $user) {
							$data['lvl5'][] = array(
								'id' => $user->id,
								'name' => $user->firstname . ' ' . $user->lastname,
								'pointvalue' => $user->pointvalue,
								'position' => $user->position,
							);

							// LEVEL 6 MEMBERS
							$lvl6 = User::where('directupline', '=', $user->id)->get();

							foreach ($lvl6 as $user) {
								$data['lvl6'][] = array(
									'id' => $user->id,
									'name' => $user->firstname . ' ' . $user->lastname,
									'pointvalue' => $user->pointvalue,
									'position' => $user->position,
								);

								// LEVEL 7 MEMBERS
								$lvl7 = User::where('directupline', '=', $user->id)->get();

								foreach ($lvl7 as $user) {
									$data['lvl7'][] = array(
										'id' => $user->id,
										'name' => $user->firstname . ' ' . $user->lastname,
										'pointvalue' => $user->pointvalue,
										'position' => $user->position,
									);

									// LEVEL 8 MEMBERS
									$lvl8 = User::where('directupline', '=', $user->id)->get();

									foreach ($lvl8 as $user) {
										$data['lvl8'][] = array(
											'id' => $user->id,
											'name' => $user->firstname . ' ' . $user->lastname,
											'pointvalue' => $user->pointvalue,
											'position' => $user->position,
										);

										// LEVEL 9 MEMBERS
										$lvl9 = User::where('directupline', '=', $user->id)->get();

										foreach ($lvl9 as $user) {
											$data['lvl9'][] = array(
												'id' => $user->id,
												'name' => $user->firstname . ' ' . $user->lastname,
												'pointvalue' => $user->pointvalue,
												'position' => $user->position,
											);

											// LEVEL 10 MEMBERS
											$lvl10 = User::where('directupline', '=', $user->id)->get();

											foreach ($lvl10 as $user) {
												$data['lvl10'][] = array(
													'id' => $user->id,
													'name' => $user->firstname . ' ' . $user->lastname,
													'pointvalue' => $user->pointvalue,
													'position' => $user->position,
												);

												// LEVEL 11 MEMBERS
												$lvl11 = User::where('directupline', '=', $user->id)->get();

												foreach ($lvl11 as $user) {
													$data['lvl11'][] = array(
														'id' => $user->id,
														'name' => $user->firstname . ' ' . $user->lastname,
														'pointvalue' => $user->pointvalue,
														'position' => $user->position,
													);

													// LEVEL 12 MEMBERS
													$lvl12 = User::where('directupline', '=', $user->id)->get();

													foreach ($lvl12 as $user) {
														$data['lvl12'][] = array(
															'id' => $user->id,
															'name' => $user->firstname . ' ' . $user->lastname,
															'pointvalue' => $user->pointvalue,
															'position' => $user->position,
														);

														// LEVEL 13 MEMBERS
														$lvl13 = User::where('directupline', '=', $user->id)->get();

														foreach ($lvl13 as $user) {
															$data['lvl13'][] = array(
																'id' => $user->id,
																'name' => $user->firstname . ' ' . $user->lastname,
																'pointvalue' => $user->pointvalue,
																'position' => $user->position,
															);

															// LEVEL 14 MEMBERS
															$lvl14 = User::where('directupline', '=', $user->id)->get();

															foreach ($lvl14 as $user) {
																$data['lvl14'][] = array(
																	'id' => $user->id,
																	'name' => $user->firstname . ' ' . $user->lastname,
																	'pointvalue' => $user->pointvalue,
																	'position' => $user->position,
																);

																// LEVEL 15 MEMBERS
																$lvl15 = User::where('directupline', '=', $user->id)->get();

																foreach ($lvl15 as $user) {
																	$data['lvl15'][] = array(
																		'id' => $user->id,
																		'name' => $user->firstname . ' ' . $user->lastname,
																		'pointvalue' => $user->pointvalue,
																		'position' => $user->position,
																	);

																}

															}

														}

													}

												}

											}

										}

									}

								}

							}

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