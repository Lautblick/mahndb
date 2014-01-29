<?php defined('SYSPATH') or die('No direct script access.');

class Model_Appointment extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_appointments';
	// Relationships
	protected $_belongs_to = array(
		'case' => array(
			'model' => 'case',
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
