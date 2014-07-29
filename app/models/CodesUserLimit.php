<?php

class CodesUserLimit extends Eloquent {

	protected $table = 'codes_user_limit';

	public static function allocateCodes($data)
	{
		$codes_user_limit = new CodesUserLimit;

		foreach ($data as $key => $value) {
			$codes_user_limit->$key = $value;
		}
		
		$codes_user_limit->save();

		return 'Codes Added';
	}

	public static function getAllocations($limit)
	{
		$codes_user_limit = DB::table('codes_user_limit')
					->orderBy('ref', 'desc')
                    ->take($limit)
                    ->get();

		return $codes_user_limit;
	}
}