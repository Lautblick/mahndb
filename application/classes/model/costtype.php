<?php defined('SYSPATH') or die('No direct script access.');
require APPPATH.'config/myconf'.EXT;
class Model_Costtype extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_cost_types';
	
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
