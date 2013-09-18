<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tenancy extends ORM
{
	protected $_has_many = array(
		'cases' => array(),
	);
}
