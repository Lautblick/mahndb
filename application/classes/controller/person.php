<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Person extends Controller
{
	
	
	public function action_get_list_item()
	{
		$id = $_POST['person_id'];
		$add_as = $_POST['add_as'];
			
		$person = ORM::factory('person', $id);
		$person_list_item = View::factory('person_list_item');
		$person_list_item->person = $person;
		$person_list_item->add_as = $add_as;
		
		echo $person_list_item;
	}
	
	/**
	 * /person/addperson POST
	 */
	public function action_addperson()
	{
		if(Request::current()->method() === Request::POST):
			$id = 0;
			if(isset($_POST['person_id']))
				$id = $_POST['person_id'];
			$case = ORM::factory('case', $_POST['case_id']);
			$person = ORM::factory('person', $id);
			if(!$person->loaded()):
				$person->values($_POST);
				$address = ORM::factory('address');
				$address->values($_POST);
				$place = ORM::factory('place', $_POST['zipcode']);
				if(!$place->loaded()):
					$place->id = $_POST['zipcode'];
					$place->place_name = $_POST['place_name'];
					$place->save();
				endif;
				$address->place_id = $place->id;
				$address->save();
				$person->address_id = $address->id;
				$person->save();
			endif;
			
			if($_POST['add_as'] == 'claimants' || $_POST['add_as'] == 'defendants') {
				$person_list_item = View::factory('person_list_item');
				$person_list_item->person = $person;
				$person_list_item->add_as = $_POST['add_as'];
				if(!$case->has($_POST['add_as'], $person)):
					$case->add($_POST['add_as'], $person);
				endif;
				$case->save();
				echo $person_list_item;
			}
			else if($_POST['add_as'] == 'cl_lawyers') {
				$case->cl_lawyer_id = $person->id;
				$case->save();
				echo $person->id.':'.$person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
			}
			else if($_POST['add_as'] == 'def_lawyers') {
				$case->def_lawyer_id = $person->id;
				$case->save();
				echo $person->id.':'.$person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
			}
			else if($_POST['add_as'] == 'bailiffs') {
				$case->bailiff_id = $person->id;
				$case->save();
				echo $person->id.':'.$person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
			}
			else if($_POST['add_as'] == 'syndicates') {
				$case->syndicate_id = $person->id;
				$case->save();
				echo $person->id.':'.$person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
			}
			else if($_POST['add_as'] == 'clubs') {
				$case->club_id = $person->id;
				$case->save();
				echo $person->id.':'.$person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
			}
		endif;
	}

	/**
	 * /person/update/<person->id> POST
	 */
	public function action_update()
	{
		$id = $this->request->param('id');
		$person = ORM::factory('person', $id);
		if($person->loaded()):
			$person->values($_POST);
			$address = ORM::factory('address');
			$address->values($_POST);
			$place = ORM::factory('place', $_POST['zipcode']);
			if(!$place->loaded()):
				$place->id = $_POST['zipcode'];
				$place->place_name = $_POST['place_name'];
				$place->save();
			endif;
			$address->place_id = $place->id;
			$address->save();
			$person->address_id = $address->id;
			$person->save();
		endif;
	}

	/**
	 * /person/unlinkperson POST
	 */
	public function action_unlinkperson() {
		$case = ORM::factory('case', $_POST['case_id']);
		$person = ORM::factory('person', $_POST['person_id']);
		if($_POST['add_as'] == 'claimants' || $_POST['add_as'] == 'defendants') {
			if($case->has($_POST['add_as'], $person)):
				$case->remove($_POST['add_as'], $person);
			endif;
		}
	}

	/**
	 * /person/getedit POST
	 */
	public function action_getedit() {

		$user = Auth::instance()->get_user();
		$roles = array();
		if($user) {
			foreach (ORM::factory('user', $user->id)->roles->find_all() as $role) {
				array_push($roles, $role->name);
			}
		}

		$person = ORM::factory('person', $_POST['person_id']);
		$users = ORM::factory('user')->find_all();
		$person_edit = View::factory('person_edit');
		$person_edit->person = $person;
		$person_edit->roles = $roles;
		$person_edit->users = $users;
		
		echo $person_edit;
	}

	/**
	 * /person/getname POST
	 */
	public function action_getname() {
		$person = ORM::factory('person', $_POST['person_id']);
		echo $person->person_title.' '.$person->person_firstname.' '.$person->person_lastname;
	}
	
}
