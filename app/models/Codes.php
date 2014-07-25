<?php

class Codes extends Eloquent {

	protected $table = 'codes';

	public static function makeCode($data) 
	{

		$codes = new Codes;

		foreach ($data as $key => $value) {
			$codes->$key = $value;
		}

		$codes->save();

		return 1;

	}

	public static function getCodes()
	{
		$id = Auth::user()->id;
		$codes = Codes::where('sponsor', '=', $id)->where('status', '!=', 1)->take(100)->get();

		foreach ($codes as $code) {
			$data[] = array(
				'membertype' => $code->membertype,
				'activationcode' => Crypt::decrypt($code->activationcode),
			);
		}
		return $data;
	}

	public static function validateCode($data)
	{
		$codetoverify = $data;
		$info = false;
		$codes = Codes::all();

		foreach ($codes as $code) 
		{
			if(Crypt::decrypt($code['activationcode']) == $codetoverify)
			{	
				$info[] = array(
					'sponsor' => $code['sponsor'],
					'membertype' => $code['membertype'],
					'code_id' => $code['id'],
				);
				if ($code['status'] == 1)
				{
					return false;
				}
			}
		}
		return $info;
	}

	public static function updateCode($data, $process)
	{
		$id = $data;

		if($process == 'used')
		{
			$codes = Codes::find($id);
			$codes->status = 1;
			$codes->save();
		}

		return 'Code updated';
	}
}