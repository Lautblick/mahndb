<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_events';

	protected $_belongs_to = array(
		'case' => array(),
		'eventtype' => array(
			'foreign_key' => 'event_type_id'
		),
	);
}
