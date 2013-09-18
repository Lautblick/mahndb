<?php defined('SYSPATH') or die('No direct script access.');

class Model_Place extends ORM
{
	protected $_has_many = array(
		'addresses' => array(),
	);
}
