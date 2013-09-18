<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends ORM
{
	protected $_belongs_to = array(
		'case' => array(),
		'eventtype' => array(
			'foreign_key' => 'event_type_id'
		),
	);
}
