<?php defined('SYSPATH') or die('No direct script access.');

class Model_Claimants extends ORM
{
	protected $_table_name = 'mahn_claimants';
	
	// Relationships
	protected $_belongs_to = array(
		'mahn_cases' => array(
		),
		'persons' => array(
		),	
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
