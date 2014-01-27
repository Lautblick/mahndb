<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'orm',
	'hash_method'  => 'sha256',
	'hash_key'     => 'Give it away',
	'lifetime'     => 7200,
	'session_key'  => 'auth_user'

);
?>