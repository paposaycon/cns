<?php

class CodesController extends BaseController {

	public function generateCode() 
	{
		$data = array();
		$result = '';
		$count = Input::get('count');

		for ($i=0; $i < $count; $i++) { 

			$data['activationcode'] = Crypt::encrypt(str_random(20));
			$data['membertype'] = Input::get('membertype');
			$data['status'] = 0;
			$data['sponsor'] = Auth::user()->id;
			$result = $result + Codes::makeCode($data);	
		}

		Mail::send('emails.codes', $data, function($message)
		{
			$message->from('admin@adzbite.com', 'Adzbite Solutions');
		    $message->to(Auth::user()->email, Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname)->subject('Registration Codes');
		});

		return $result . " activation codes added.";
	}

	public function showCodes()
	{
		$result = Codes::getCodes();
		return json_encode($result);
	}

	// Model -> Codes_user_limit.php
	public function allocateCodes()
	{
		$id = Input::get('id');
		$count = Input::get('count');
		$allocated_by = Auth::user()->id;

		$data = array(
			'id' => $id,
			'count' => $count,
			'allocated_by' => $allocated_by,
		);

		return CodesUserLimit::allocateCodes($data);
	}

	public function getAllocations()
	{
		return json_encode(CodesUserLimit::getAllocations(10));
	}

}
