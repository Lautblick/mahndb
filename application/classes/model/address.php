<?php defined('SYSPATH') or die('No direct script access.');

class Model_Address extends ORM
{
	protected $_belongs_to = array(
		'person' => array(),
		'tenancy' => array(),
		'place' => array(),
	);

	protected $_has_many = array(
	);
}
