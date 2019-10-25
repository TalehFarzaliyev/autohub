<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends Main_Model {

	public $table = 'faqs';
	public $primary_key = 'id';

	public $relation_tables = [
		[
			'name'		=> 'faq_translation',
			'column'	=> 'faq_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
	}
}