<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Case extends Controller
{
	/**
	 * /case/show/<case->id> GET
	 */
	public function action_show()
	{

		$user = Auth::instance()->get_user();
		$roles = array();
		if($user) {
			foreach (ORM::factory('user', $user->id)->roles->find_all() as $role) {
				array_push($roles, $role->name);
			}
		}

		$id = $this->request->param('id');

		$the_case = ORM::factory('case', $id);
		// var_dump($the_case->id); die();
		$case_types = ORM::factory('casetype')->find_all();
		$event_types = ORM::factory('eventtype')->find_all();
		$cost_types = ORM::factory('costtype')->find_all();
		$statuses = ORM::factory('status')->find_all();
		$users = ORM::factory('user')->find_all();
		$details_content = View::factory('case_details');
		$details_content->the_case = $the_case;
		$details_content->case_types = $case_types;
		$details_content->event_types = $event_types;
		$details_content->cost_types = $cost_types;
		$details_content->statuses = $statuses;
		$details_content->roles = $roles;
		$details_content->users = $users;
		
		echo $details_content;
	}
	
	/**
	 * /case/show/<case->id> GET
	 */
	public function action_get_list_item()
	{
		$id = $_POST['case_id'];
			
		$the_case = ORM::factory('case', $id);
		$case_list_item = View::factory('case_list_item');
		$case_list_item->the_case = $the_case;
		
		echo $case_list_item;
	}

	/**
	 * /case/new GET
	 */
	public function action_new()
	{
		$the_case = ORM::factory('case');
		$the_case->case_created = date("Y-m-d H:i:s");
		$all_curr = ORM::factory('case')->where(array(DB::expr('YEAR(case_created)')), '=', date("Y"))->find_all();
		$the_case->case_nr = sizeOf($all_curr) + 1;
		$the_case->save();
		if($this->request->is_ajax()):
			$this->auto_render = false;
			echo $the_case->id;
		endif;
	}

	/**
	 * /case/update/<case->id> POST
	 */
	public function action_update()
	{
		$id = $this->request->param('id');
		$the_case = ORM::factory('case', $id);
		
		$tenancy = ORM::factory('tenancy')->where('tenancy_ve', '=', $_POST['tenancy_ve'])->find();
		if(!$tenancy->loaded()):
			$tenancy->tenancy_ve = $_POST['tenancy_ve'];
		endif;
		$tenancy->tenancy_position = $_POST['tenancy_position'];

		$address = ORM::factory('address');
		// $address->values($_POST);
		$address->address_street = $_POST['tenancy_street'];
		$place = ORM::factory('place', $_POST['tenancy_zip']);
		if(!$place->loaded()):
			$place->id = $_POST['tenancy_zip'];
			$place->place_name = $_POST['tenancy_city'];
			$place->save();
		endif;
		$address->place_id = $place->id;
		$address->save();
		$tenancy->address_id = $address->id;
		$tenancy->save();
		
		$case_type = ORM::factory('casetype')->where('type_name', '=', $_POST['case_type'])->find();
		if(!$case_type->loaded()):
			$case_type->type_name = $_POST['case_type'];
			$case_type->save();
		endif;
		
		$the_case->values($_POST);
		
		$the_case->case_followup = date('Y-m-d', strtotime($_POST['case_followup']));
		$the_case->cl_lawyer_charged = date('Y-m-d', strtotime($_POST['cl_lawyer_charged']));
		
		$the_case->tenancy_id = $tenancy->id;
		$the_case->case_type_id = $case_type->id;
		$the_case->save();
	}

	/**
	 * /case/update/<case->id> GET
	 */
	public function action_sendmail()
	{
		$id = $this->request->param('id');
		$the_case = ORM::factory('case', $id);
		
		$case_types = ORM::factory('casetype')->find_all();
		$event_types = ORM::factory('eventtype')->find_all();
		$cost_types = ORM::factory('costtype')->find_all();
		$details_content = View::factory('case_details_mail');
		$details_content->the_case = $the_case;
		$details_content->case_types = $case_types;
		$details_content->event_types = $event_types;
		$details_content->cost_types = $cost_types;		

		$recipients = ORM::factory('user')->where('common_note', '=', '1')->find_all();

		$auftraggeber = $the_case->claimants->where('user_id', 'IS NOT', NULL)->find_all();

		$email = Email::factory('Fall '.$the_case->tenancy->tenancy_ve.' wurde aktualisiert')
			->message($details_content, 'text/html')
		    ->from('info@agv-essen.de', 'Assindia Grundstücksverwaltung GmbH');

		foreach ($recipients as $recipient) {
			$email->to($recipient->email);
		}
		foreach ($auftraggeber as $auftraggeber_item) {
			$user = ORM::factory('user', $auftraggeber_item->user_id);
			$email->to($user->email);
		}
		$email->send();
	}

	/**
	 * /case/delete/<case->id> GET - Question
	 * /case/delete/<case->id> POST - Confirmation
	 */
	public function action_delete()
	{
		$id = $this->request->param('id');
		$the_case = ORM::factory('case', $id);
		$the_case->case_deleted = 1;
		$the_case->save();
	}

	/**
	 * /case/printlist/
	 */
	public function action_printlist($selectedList)
	{
		if($selectedList == 1) {
			$cases = ORM::factory('case')->with('tenancy')->with('cl_lawyer')->with('def_lawyer')->where('case_active', '=', '0')->order_by('tenancy_ve', 'asc')->find_all();
		}
		else if ($selectedList == 2) {
			$upcoming_appointments = ORM::factory('appointment')
				->where('appointment_datetime', '>=', '2013-10-04 00:00:00')
				->and_where('appointment_datetime', '<', '2013-11-04 00:00:00')
				->order_by('appointment_datetime', 'asc')
				->find_all();
		}
		else {
			$cases = ORM::factory('case')->with('tenancy')->with('cl_lawyer')->with('def_lawyer')->where('case_active', '=', '1')->order_by('tenancy_ve', 'asc')->find_all();
		}

		if($selectedList != 2) {
			$case_list = View::factory('case_list');
			$case_list->cases = $cases;
		}
		else {
			$case_list = View::factory('upcoming_appointments_list');
			$case_list->upcoming_appointments = $upcoming_appointments;
		}
		$print = View::factory('main_print');
		$print->list_content = $case_list;
		echo $print;
	}
}


















