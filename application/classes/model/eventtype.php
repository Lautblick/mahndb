<?php defined('SYSPATH') or die('No direct script access.');
require APPPATH.'config/myconf'.EXT;
class Model_Eventtype extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_event_types';
	
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
