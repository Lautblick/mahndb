<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Case extends Controller
{
	/**
	 * /case/show/<case->id> GET
	 */
	public function action_show()
	{
		$id = $this->request->param('id');
			
		$the_case = ORM::factory('case', $id);
		$case_types = ORM::factory('casetype')->find_all();
		$event_types = ORM::factory('eventtype')->find_all();
		$cost_types = ORM::factory('costtype')->find_all();
		$details_content = View::factory('case_details');
		$details_content->the_case = $the_case;
		$details_content->case_types = $case_types;
		$details_content->event_types = $event_types;
		$details_content->cost_types = $cost_types;
		
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
			$tenancy->save();
		endif;
		
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
	public function action_printlist()
	{
		$cases = ORM::factory('case')->where('case_deleted', '=', '0')->order_by('case_active', 'desc')->order_by('case_followup', 'asc')->find_all();
		$case_list = View::factory('case_list');
		$case_list->cases = $cases;
		$print = View::factory('main_print');
		$print->list_content = $case_list;
		echo $print;
	}
}


















