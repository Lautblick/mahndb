<?php defined('SYSPATH') or die('No direct script access.');

class Model_Person extends ORM
{
	protected $_table_name = 'persons';

	// Relationships
	protected $_has_many = array(
		'claimants' => array(
			'model' => 'person',
			'through' => 'claimants',
		),
		'defedants' => array(
			'model' => 'person',
			'through' => 'defendants',
		),
		/*
		'cl_lawyers' => array(
			'model' => 'person',
			'through' => 'cl_lawyers',
		),
		'def_lawyers' => array(
			'model' => 'person',
			'through' => 'def_lawyers',
		),
		*/
	);

	protected $_belongs_to = array(
		'address' => array(),
		'cases' => array(),
	);

	// Custom methods
	public function find_filtered()
	{

	}
}
