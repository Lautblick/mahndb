<?php defined('SYSPATH') or die('No direct script access.');

class Model_Eventtype extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = $strings['table.prefix'] . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_event_types';
	
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
