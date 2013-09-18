<?php defined('SYSPATH') or die('No direct script access.');

class Model_Defendants extends ORM
{
	protected $_table_name = 'defendants';

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
