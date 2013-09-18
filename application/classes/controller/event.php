<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Event extends Controller {
	
	
	public function action_get_list_item()
	{
		$id = $_POST['event_id'];
			
		$event = ORM::factory('event', $id);
		$event_list_item = View::factory('event_list_item');
		$event_list_item->event = $event;
		
		echo $event_list_item;
	}
	
	public function action_addevent() {
		
		if(Request::current()->method() === Request::POST):
		
			$case = ORM::factory('case', $_POST['case_id']);
			$event = ORM::factory('event');
			$event->values($_POST);
			$event_type = ORM::factory('eventtype')->where('type_name', '=', $_POST['event_type'])->find();
			if(!$event_type->loaded()):
				$event_type->type_name = $_POST['event_type'];
				$event_type->save();
			endif;
			if($event_type->type_name == 'Verfahren beendet') {
				$case->case_active = 0;
			}
			$event->event_type_id = $event_type->id;
			$event->event_date = date('Y-m-d', strtotime($_POST['event_date']));
			$event->save();
			$case->save();
			
			$event_list_item = View::factory('event_list_item');
			$event_list_item->event = $event;
			$event_list_item->eventtype = $_POST['event_type'];
			echo $event_list_item;
		endif;
	}

	/**
	 * /event/update/<event->id> POST
	 */
	public function action_update()
	{
		$id = $this->request->param('id');
		$event = ORM::factory('event', $id);
		if($event->loaded()):
			$event->values($_POST);
			$event->event_date = date('Y-m-d', strtotime($_POST['event_date']));
			$event->save();
		endif;
	}

	/**
	 * /event/delete POST
	 */
	public function action_delete() {
		$event = ORM::factory('event', $_POST['event_id']);
		if($event->loaded()):
			$event->delete();
		endif;
	}
	
	public function action_uploadattachment() {
		
		$tempname = $_FILES['File']['tmp_name'];
		$name = $_FILES['File']['name'];
		$type = $_FILES['File']['type'];
		
		$uniqid = uniqid(); 
		$dir = "uploads/";
		$ziel = $dir.$uniqid.'_'.$name; 
		
		move_uploaded_file  ( $tempname  , $ziel ); 
				
		echo $content; 
	}

	/**
	 * /event/getedit POST
	 */
	public function action_getedit() {
		$event = ORM::factory('event', $_POST['event_id']);
		$event->event_date = date('d.m.Y', strtotime($event->event_date));
		$event_edit = View::factory('event_edit');
		$event_edit->event = $event;
		
		echo $event_edit;
	}
}
