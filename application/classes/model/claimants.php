<?php defined('SYSPATH') or die('No direct script access.');

class Model_Claimants extends ORM
{
	$string = array();
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	}
	protected $_table_name = '_claimants';
	
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
