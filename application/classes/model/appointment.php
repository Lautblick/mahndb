<?php defined('SYSPATH') or die('No direct script access.');

class Model_Appointment extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_appointments';
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
