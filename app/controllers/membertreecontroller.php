<?php

class MembertreeController extends BaseController {

	public function showMemberTree()
	{
		$lvl['0']['0']['0'] = array( 
			'id' => Auth::user()->id,
			'username' => Auth::user()->username,
		);

		
		for ($level=0; $level < 6 ; $level++) {

			if($level == 0)
			{
				$counter1 = 1;
			}
			else
			{
				$counter1 = $level;
			}

			$makegroup = -1;

			for ($group=0; $group < $counter1; $group++) { 

				$prevgroup = $group;
				

				if ($level == 0) {
					$downline['left'] = User::getDownline($lvl[0][0][0]['id'], 1);
					$downline['right'] = User::getDownline($lvl[0][0][0]['id'], 2);
				}

				for ($position=0; $position < 2; $position++) {
					$makegroup = $makegroup + 1;
					#Start Binary Data
					if ($level != 0) {
						$downline['left'] = User::getDownline($lvl[$level][$prevgroup][$position]['id'], 1);
						$downline['right'] = User::getDownline($lvl[$level][$prevgroup][$position]['id'], 2);
					}
					

					$lvl[$level + 1][$makegroup]['0'] = array(
						'id'        => null,
						'username'  => 'None',
						'firstname' => 'None',
						'lastname'  => 'None',
						'middlename'=> 'None',
						'sponsor'   => 'None',
						'position'  => 'None',
					);
					$lvl[$level + 1][$makegroup]['1'] = array(
						'id'        => null,
						'username'  => 'None',
						'firstname' => 'None',
						'lastname'  => 'None',
						'middlename'=> 'None',
						'sponsor'   => 'None',
						'position'  => 'None',
					);
					foreach ($downline['left'] as $data) {
						$lvl[$level + 1][$makegroup]['0'] = array(
							'id'        => $data->id,
							'username'  => $data->username,
							'firstname' => $data->firstname,
							'lastname'  => $data->lastname,
							'middlename'=> $data->middlename,
							'sponsor'   => $data->sponsor,
							'position'  => $data->position,
						);
					}
					foreach ($downline['right'] as $data) {
						$lvl[$level + 1][$makegroup]['1'] = array(
							'id'        => $data->id,
							'username'  => $data->username,
							'firstname' => $data->firstname,
							'lastname'  => $data->lastname,
							'middlename'=> $data->middlename,
							'sponsor'   => $data->sponsor,
							'position'  => $data->position,
						);
					}
					
					#END FOREACH
				}
			}
		}

		return View::make('account/membertree', array(
			'page_title'   => 'Members',
			'lvl'   => $lvl,
		));
	}

}
