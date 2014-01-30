<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User
{
	protected $_table_name = 'mahn_users';

	// Relationships
	protected $_has_many = array(
		'roles' => array(
			'model' => 'role',
			'through' => 'mahn_roles_users',
		),
	);
}
