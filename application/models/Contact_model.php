<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends Main_Model {

	public $table = 'contacts';
	public $primary_key = 'id';
	public $protected = [];

	public $relation_tables = [
		[
			'name'		=> 'contact_translation',
			'column'	=> 'contact_id',
			'delete'	=> TRUE,
		]
	];
	public function __construct()
	{
		parent::__construct();
	}

	public function get_contact_translation($select, $where, $sort = false, $limit = false)
	{
		$this->db->select($select);
		$this->db->from('contact_translation');

		$this->db->where($where);

		if($limit)
		{
			$this->db->limit($limit['per_page'], ($limit['page']-1)*$limit['per_page']);
		}

		if($sort)
		{
			$this->db->order_by($sort['column'], $sort['order']);
		}

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}

	public function insert_contact_translation($data)
	{
		$this->db->insert('contact_translation',$data);
	}

	public function delete_contact_translation($contact_id)
	{
		$this->db->where('contact_id', $contact_id);
		$this->db->delete('contact_translation');
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
