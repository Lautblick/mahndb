<?php defined('SYSPATH') or die('No direct access allowed.');
require APPPATH.'config/myconf'.EXT;
class Model_Role extends Model_Auth_Role {

	protected $_table_name = $STRINGTABLE['table_prefix'] . '_roles';

	// This class can be replaced or extended

} // End Role Model