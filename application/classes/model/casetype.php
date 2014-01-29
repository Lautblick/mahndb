<?php defined('SYSPATH') or die('No direct script access.');
require APPPATH.'config/myconf'.EXT;
class Model_Casetype extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_case_types';
	
	protected $_has_many = array(
		'mahn_cases' => array(),
	);
}
