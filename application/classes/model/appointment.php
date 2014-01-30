<?php defined('SYSPATH') or die('No direct script access.');

class Model_Appointment extends ORM
{
	protected $_table_name = 'mahn_appointments';
	// Relationships
	protected $_belongs_to = array(
		'case' => array(
			'model' => 'case',
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
