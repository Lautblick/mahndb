<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index() {

		$user = Auth::instance()->get_user();
		$roles = array();
		if($user) {
			foreach (ORM::factory('user', $user->id)->roles->find_all() as $role) {
				array_push($roles, $role->name);
			}
		}

		if(in_array('login', $roles)) {
			
			$view = View::factory('main');
					
			$cases = ORM::factory('case')->with('tenancy')->with('cl_lawyer')->with('def_lawyer')->where('case_active', '=', '1')->order_by('tenancy_ve', 'asc')->find_all();
			$case_list = View::factory('case_list');
			$case_list->cases = $cases;
			$case_list->the_case_id = 0;
					
			$cases_closed = ORM::factory('case')->with('tenancy')->with('cl_lawyer')->with('def_lawyer')->where('case_active', '=', '0')->order_by('tenancy_ve', 'asc')->find_all();
			$case_list_closed = View::factory('case_list');
			$case_list_closed->cases = $cases_closed;
			$case_list_closed->the_case_id = 0;

			$upcoming_appointments = ORM::factory('appointment')
				->where('appointment_datetime', '>=', '2013-10-04 00:00:00')
				->and_where('appointment_datetime', '<', '2013-11-04 00:00:00')
				->order_by('appointment_datetime', 'asc')
				->find_all();
					
			$upcoming_appointments_list = View::factory('upcoming_appointments_list');
			$upcoming_appointments_list->upcoming_appointments = $upcoming_appointments;
			$upcoming_appointments_list->the_case_id = 0;
			
			$details_content = '';
			
			$persons = ORM::factory('person')->find_all();
			$case_types = ORM::factory('casetype')->find_all();
			$cost_types = ORM::factory('costtype')->find_all();
			$event_types = ORM::factory('eventtype')->find_all();
			$statuses = ORM::factory('status')->find_all();
			
			$view->list_content = $case_list;
			$view->list_content_closed = $case_list_closed;
			$view->list_content_appointment = $upcoming_appointments_list;
			$view->details_content = $details_content;
			$view->persons = $persons;
			$view->case_types = $case_types;
			$view->cost_types = $cost_types;
			$view->event_types = $event_types;
			$view->statuses = $statuses;
			$view->roles = $roles;
			
			$this->response->body($view->render());
		}
		else {
			Request::current()->redirect('user/login');
		}
	}

} // End Welcome
