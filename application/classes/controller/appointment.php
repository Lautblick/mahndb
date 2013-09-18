<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Appointment extends Controller {
	
	public function action_addappointment() {
		
		if(Request::current()->method() === Request::POST):
			$case = ORM::factory('case', $_POST['case_id']);
			$appointment = ORM::factory('appointment');
			$appointment->values($_POST);
			
			$appointment->appointment_datetime = date('Y-m-d H:i', strtotime($_POST['appointment_date'].' '.$_POST['appointment_hour'].':'.$_POST['appointment_minute']));
			$appointment->save();
			$case->save();
			
			$appointment_list_item = View::factory('appointment_list_item');
			$appointment_list_item->appointment = $appointment;
			echo $appointment_list_item;
		endif;
	}
	
	public function action_get_list_item()
	{
		$id = $_POST['appointment_id'];
			
		$appointment = ORM::factory('appointment', $id);
		$appointment_list_item = View::factory('appointment_list_item');
		$appointment_list_item->appointment = $appointment;
		
		echo $appointment_list_item;
	}

	/**
	 * /appointment/update/<appointment->id> POST
	 */
	public function action_update()
	{
		$id = $this->request->param('id');
		$appointment = ORM::factory('appointment', $id);
		if($appointment->loaded()):
			$appointment->values($_POST);
			$appointment->appointment_datetime = date('Y-m-d', strtotime($_POST['appointment_date'])).' '.$_POST['appointment_hour'].':'.$_POST['appointment_minute'];
			$appointment->save();
		endif;
	}

	/**
	 * /appointment/delete POST
	 */
	public function action_delete() {
		$appointment = ORM::factory('appointment', $_POST['appointment_id']);
		if($appointment->loaded()):
			$appointment->delete();
		endif;
	}
	
	/**
	 * /appointment/getedit POST
	 */
	public function action_getedit() {
		$appointment = ORM::factory('appointment', $_POST['appointment_id']);
		$appointment_edit = View::factory('appointment_edit');
		$appointment_edit->appointment = $appointment;
		
		echo $appointment_edit;
	}
}
