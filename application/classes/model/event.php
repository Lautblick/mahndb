<?php defined('SYSPATH') or die('No direct script access.');
require APPPATH.'config/myconf'.EXT;
class Model_Event extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_events';

	protected $_belongs_to = array(
		'case' => array(),
		'eventtype' => array(
			'foreign_key' => 'event_type_id'
		),
	);
}
