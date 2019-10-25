<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends Main_Model {

	public $table = 'city';
	public $primary_key = 'id';
	public $relation_tables = [
		[
			'name'		=> 'city_translation',
			'column'	=> 'city_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{
		$this->timestamps = FALSE;
		$this->soft_deletes = FALSE;
		parent::__construct();
	}

	// public function get_product_to_category($select, $where)
	// {
	// 	$this->db->select($select);
	// 	$this->db->from('wc_product_to_category');
	// 	$this->db->where($where);

	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }

	// public function get_category_by_product_id($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('wc_product_to_category pc');
	// 	$this->db->join('wc_product_categories p', 'p.id = pc.category_id','inner');
	// 	$this->db->where('pc.product_id',$id);
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }

	// public function get_product_by_category_id($where)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('wc_product_to_category');
	// 	$this->db->where($where);
	// 	$this->db->join('wc_products', 'wc_products.id = wc_product_to_category.product_id');
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }


	public function insert_tour_to_cc($data)
	{
		$this->db->insert('wc_tour_to_city', $data);
	}

	public function delete_tour_to_cc($id)
	{
		$this->db->delete('wc_tour_to_city', ['tour_id' => $id]);
	}

	public function get_tour_to_hotel($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_tour_to_hotel');
		$this->db->where($where);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
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