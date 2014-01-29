<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cl_lawyers extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = $strings['table.prefix'] . $this->_table_name;
		parent::__construct();
	} protected $_table_name = 'cl_lawyers';
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
