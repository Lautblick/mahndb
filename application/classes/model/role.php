<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role {

	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = $strings['table.prefix'] . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_roles';

	// This class can be replaced or extended

} // End Role Model