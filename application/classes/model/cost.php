<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cost extends ORM
{
	protected $_belongs_to = array(
		'case' => array(),
		'costtype' => array(
			'foreign_key' => 'cost_type_id'
		),
	);
}