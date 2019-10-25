<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends Main_Model {

	public $table = 'referee';
	public $primary_key = 'id';

	public $relation_tables = [
		[
			'name'		=> 'referee_translation',
			'column'	=> 'referee_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
    }
}