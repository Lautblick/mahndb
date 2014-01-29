<?php defined('SYSPATH') or die('No direct script access.');

class Model_Costtype extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_cost_types';
	
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
