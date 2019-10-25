<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends Main_Model {

	public $table = 'groups';
	public $primary_key = 'id';
	public $protected = [];

	public function __construct()
	{
		parent::__construct();
	}
}