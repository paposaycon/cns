<?php

class MembertreeController extends BaseController {

	public function getDownline()
	{
		$result = User::getDownline(Auth::user()->id);
		return json_encode($result);
	}

	public function showMemberTree()
	{
		$members = User::getDownline(Auth::user()->id);

		return View::make('account/membertree', array(
			'page_title' => 'Members',
			'members' => $members,

		));
	}

}
