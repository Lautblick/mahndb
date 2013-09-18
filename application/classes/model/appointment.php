<?php defined('SYSPATH') or die('No direct script access.');

class Model_Appointment extends ORM
{
	protected $_table_name = 'appointments';
	// Relationships
	protected $_belongs_to = array(
		'cases' => array(
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
