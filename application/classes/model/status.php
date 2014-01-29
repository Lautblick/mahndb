<?php defined('SYSPATH') or die('No direct script access.');

class Model_status extends ORM
{
	protected $_table_name = $STRINGTABLE['table_prefix'] . '_statuses';
	// Relationships
	protected $_belongs_to = array(
		'mahn_cases' => array(
		),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
