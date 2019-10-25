<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends Main_Model {

	public $table = 'pages';
	public $primary_key = 'id';

	public $relation_tables = [
		[
			'name'		=> 'page_translation',
			'column'	=> 'page_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
	}
}