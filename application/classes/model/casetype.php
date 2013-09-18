<?php defined('SYSPATH') or die('No direct script access.');

class Model_Casetype extends ORM
{
	protected $_table_name = 'case_types';
	
	protected $_has_many = array(
		'cases' => array(),
	);
}
