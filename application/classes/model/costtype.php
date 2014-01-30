<?php defined('SYSPATH') or die('No direct script access.');

class Model_Costtype extends ORM
{
	protected $_table_name = 'mahn_cost_types';
	
	// Relationships
	protected $_has_many = array(
		'costs' => array(
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
