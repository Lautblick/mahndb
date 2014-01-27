<?php defined('SYSPATH') or die('No direct script access.');

class Model_Eventtype extends ORM
{
	protected $_table_name = 'mahn_event_types';
	
	// Relationships
	protected $_has_many = array(
		'events' => array(
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
