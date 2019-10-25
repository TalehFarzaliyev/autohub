<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_attribute_model extends Main_Model {

	public $table = 'tour_attributes';
	public $primary_key = 'id';
	public $protected = [];

	public $relation_tables = [
		[
			'name'		=> 'tour_attribute_translation',
			'column'	=> 'tour_attribute_id',
			'delete'	=> TRUE,
		]
	];
	public function __construct()
	{
		parent::__construct();
	}

	// public function get_attribute_translation($select, $where, $sort = false, $limit = false)
	// {
	// 	$this->db->select($select);
	// 	$this->db->from('attribute_translation');

	// 	$this->db->where($where);

	// 	if($limit)
	// 	{
	// 		$this->db->limit($limit['per_page'], ($limit['page']-1)*$limit['per_page']);
	// 	}

	// 	if($sort)
	// 	{
	// 		$this->db->order_by($sort['column'], $sort['order']);
	// 	}

	// 	$query = $this->db->get();

	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }

	public function insert_attribute_translation($data)
	{
		$this->db->insert('attribute_translation',$data);
	}

	public function delete_attribute_translation($attribute_id)
	{
		$this->db->where('attribute_id', $attribute_id);
		$this->db->delete('attribute_translation');
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

	public function insert_to_attribute($data)
	{
		$this->db->insert('wc_tour_to_attribute',$data);
	}

	public function delete_tour_attribute($tour_id)
	{
		$this->db->where('tour_id', $tour_id);
		$this->db->delete('wc_tour_to_attribute');
	}

	public function get_tour_to_attribute($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_tour_to_attribute');
		$this->db->where($where);
		$this->db->limit(7);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}
}
