<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role {

	protected $_table_name = 'mahn_roles';

	// public function __construct() {
	// 	$strings = unserialize (STRINGTABLE); 
	// 	$this->_table_name = $strings['table.prefix'] . $this->_table_name;
	// 	parent::__construct();
	// } 

	// This class can be replaced or extended

} // End Role Model