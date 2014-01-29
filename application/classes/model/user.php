<?php defined('SYSPATH') or die('No direct script access.');
require APPPATH.'config/myconf'.EXT;
class Model_User extends Model_Auth_User
{

	protected $_table_name = $STRINGTABLE['table_prefix'] . '_users';

	// Relationships
	protected $_has_many = array(
		'roles' => array(
			'model' => 'role',
			'through' => 'mahn_roles_users',
		),
	);
}
