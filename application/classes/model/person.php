<?php defined('SYSPATH') or die('No direct script access.');

class Model_Person extends ORM
{
	// public function __construct() {
	// 	$strings = unserialize (STRINGTABLE); 
	// 	$this->_table_name = $strings['table.prefix'] . $this->_table_name;
	// 	parent::__construct();
	// } 

	protected $_table_name = 'persons';

	// Relationships
	protected $_has_many = array(
		'claimants' => array(
			'model' => 'person',
			'through' => 'mahn_claimants',
		),
		'defedants' => array(
			'model' => 'person',
			'through' => 'mahn_defendants',
		),
		/*
		'cl_lawyers' => array(
			'model' => 'person',
			'through' => 'cl_lawyers',
		),
		'def_lawyers' => array(
			'model' => 'person',
			'through' => 'def_lawyers',
		),
		*/
	);

	protected $_belongs_to = array(
		'address' => array(),
		'mahn_cases' => array(),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
