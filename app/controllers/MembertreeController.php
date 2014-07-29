<?php

class MembertreeController extends BaseController {

	public function getDownline()
	{
		$result = User::getDownline(Auth::user()->id);
		return json_encode($result);
	}

}
