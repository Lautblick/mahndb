<?php defined('SYSPATH') or die('No direct script access.');


class Model_Case extends ORM
{
	protected $_table_name = 'mahn_cases';

	// Small example of how rules could look like.
	protected $_rules = array(
		'case_reason' => array(
			'not_empty' => NULL,
		),
	);

	// Relationships
	protected $_has_many = array(
		'claimants' => array(
			'model' => 'person',
			'through' => 'mahn_claimants',
		),
		'defendants' => array(
			'model' => 'person',
			'through' => 'mahn_defendants',
		),
		/*
		'cl_lawyers' => array(
			'model' => 'person',
			'through' => 'cl_lawyers',
		),
		'def_lawyers' => array(
			'model' => 'person',
			'through' => 'def_lawyers',
		),
		*/
		'costs' => array(
			'model' => 'cost',
		),
		'appointments' => array(
			'model' => 'appointment',
		),
		'events' => array(
			'model' => 'event'
		),
	);

	protected $_belongs_to = array(
		'tenancy' => array(),
		'casetype' => array(
			'foreign_key' => 'case_type_id'
		),
		'status' => array(
			'foreign_key' => 'status_id'
		),
		'cl_lawyer' => array(
			'model' => 'person',
			'foreign_key' => 'cl_lawyer_id',
		),
		'def_lawyer' => array(
			'model' => 'person',
			'foreign_key' => 'def_lawyer_id',
		),
		'bailiff' => array(
			'model' => 'person',
			'foreign_key' => 'bailiff_id',
		),
		'syndicate' => array(
			'model' => 'person',
			'foreign_key' => 'syndicate_id',
		),
		'club' => array(
			'model' => 'person',
			'foreign_key' => 'club_id',
		),
	);

	// Custom methods
	public function max()
	{
		return DB::select(array(DB::expr('MAX(case_nr) AS max')))
				->from('mahn_cases')
				->execute();
	}	

	public function find_filtered()
	{

	}

	public function get_total_costs($type = false)
	{
		$total = 0.00;
		$costs = array();
		if(!$type):
			$costs = ORM::factory('cost')->find_all();
		else:
			$costtype = ORM::factory('costtype')->where('type_name', '=', $type)->find();
			$costs = ORM::factory('cost')->where('cost_type_id', '=', $costtype->id)->find_all();
		endif;
		foreach($costs as $cost):
			$total += $cost->cost_amount;
		endforeach;
		return $total;
	}
}
