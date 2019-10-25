<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Azerbaijan_model extends Main_Model {

	public $table = 'azerbaijan';
	public $primary_key = 'id';
	public $protected = [];

	public $relation_tables = [
		[
			'name'		=> 'azerbaijan_translation',
			'column'	=> 'azerbaijan_id',
			'delete'	=> TRUE,
		]
	];
	public function __construct()
	{
		parent::__construct();
	}

	public function callback_get_status($data, $params = [])
	{
		$rows = [
			'0'	=> "<span class='label label-danger'>{$this->data['text']['common']['common_disable']}</span>",
			'1'	=> "<span class='label label-success'>{$this->data['text']['common']['common_enable']}</span>"
		];

		return $rows[$data];
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
