<?php defined('SYSPATH') or die('No direct script access.');

class Model_Casetype extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = $strings['table.prefix'] . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_case_types';
	
	protected $_has_many = array(
		'mahn_cases' => array(),
	);
}
