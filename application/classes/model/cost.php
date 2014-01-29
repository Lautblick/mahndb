<?php defined('SYSPATH') or die('No direct script access.');

class Model_Cost extends ORM
{
	public function __construct() {
		$strings = unserialize (STRINGTABLE); 
		$this->_table_name = PREFIX . $this->_table_name;
		parent::__construct();
	} protected $_table_name = '_costs';

	protected $_belongs_to = array(
		'case' => array(),
		'costtype' => array(
			'foreign_key' => 'cost_type_id'
		),
	);
}
