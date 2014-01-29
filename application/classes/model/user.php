<?php defined('SYSPATH') or die('No direct script access.');


class Model_User extends Model_Auth_User
{

	protected $_table_name = 'mahn_users';

	// public function __construct() {
	// 	$strings = unserialize (STRINGTABLE); 
	// 	$this->_table_name = $strings['table.prefix'] . $this->_table_name;
	// 	parent::__construct();
	// } 

	// Relationships
	protected $_has_many = array(
		'roles' => array(
			'model' => 'role',
			'through' => 'mahn_roles_users',
		),
	);
}
