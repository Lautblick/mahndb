<?php defined('SYSPATH') or die('No direct script access.');

class Model_status extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_statuses';
	// Relationships
	protected $_belongs_to = array(
		'mahn_cases' => array(
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
