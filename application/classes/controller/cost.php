<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cost extends Controller {
	
	public function action_addcost() {
		
		if(Request::current()->method() === Request::POST):
			
			$case = ORM::factory('case', $_POST['case_id']);
			$cost = ORM::factory('cost');
			$cost->values($_POST);
			$cost_type = ORM::factory('costtype')->where('type_name', '=', $_POST['cost_type'])->find();
			if(!$cost_type->loaded()):
				$cost_type->type_name = $_POST['cost_type'];
				$cost_type->save();
			endif;
			$cost->cost_type_id = $cost_type->id;
			$cost->cost_date = date('Y-m-d', strtotime($_POST['cost_date']));
			$cost->save();
			$case->save();
			
			$cost_list_item = View::factory('cost_list_item');
			$cost_list_item->cost = $cost;
			$cost_list_item->costtype = $_POST['cost_type'];
			echo $cost_list_item;
		endif;
	}
	
	public function action_get_list_item()
	{
		$id = $_POST['cost_id'];
			
		$cost = ORM::factory('cost', $id);
		$cost_list_item = View::factory('cost_list_item');
		$cost_list_item->cost = $cost;
		
		echo $cost_list_item;
	}

	/**
	 * /cost/update/<cost->id> POST
	 */
	public function action_update()
	{
		$id = $this->request->param('id');
		$cost = ORM::factory('cost', $id);
		if($cost->loaded()):
			$cost->values($_POST);
			$cost_type = ORM::factory('costtype')->where('type_name', '=', $_POST['cost_type'])->find();
			if(!$cost_type->loaded()):
				$cost_type->type_name = $_POST['cost_type'];
				$cost_type->save();
			endif;
			$cost->cost_type_id = $cost_type->id;
			$cost->cost_date = date('Y-m-d', strtotime($_POST['cost_date']));
			$cost->save();
		endif;
	}

	/**
	 * /cost/delete POST
	 */
	public function action_delete() {
		$cost = ORM::factory('cost', $_POST['cost_id']);
		if($cost->loaded()):
			$cost->delete();
		endif;
	}
	
	/**
	 * /cost/getedit POST
	 */
	public function action_getedit() {
		$cost = ORM::factory('cost', $_POST['cost_id']);
		$cost_edit = View::factory('cost_edit');
		$cost_edit->cost = $cost;
		
		echo $cost_edit;
	}
}
