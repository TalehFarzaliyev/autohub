<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends Main_Model {

	public $table = 'categories';
	public $primary_key = 'id';

	public $relation_tables = [
		[
			'name'		=> 'category_translation',
			'column'	=> 'category_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
	}

	public function get_news_to_category($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_news_to_category');
		$this->db->where($where);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}


	public function insert_news_to_category($data)
	{
		$this->db->insert('wc_news_to_category', $data);
	}

	public function delete_news_to_category($id)
	{
		$this->db->delete('wc_news_to_category', ['news_id' => $id]);
	}


}