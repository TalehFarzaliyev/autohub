<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends Main_Model {

	public $table = 'slides';
	public $primary_key = 'id';

	public $relation_tables = [
		[
			'name'		=> 'slide_translation',
			'column'	=> 'slide_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
	}

	public function callback_get_image($data, $params = [])
	{
		if(!empty($data))
		{
			return "<img src='".$this->Model_tool_image->resize($data, $params['width'], $params['height'])."' width='".$params['width']."' height='".$params['height']."'>";
		}
		return;
	}
}