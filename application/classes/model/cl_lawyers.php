<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cl_lawyers extends ORM
{
	protected $_table_name = 'cl_lawyers';
	// Relationships
	protected $_belongs_to = array(
		'cases' => array(
		),
		'persons' => array(
		),	
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
