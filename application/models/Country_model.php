<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends Main_Model {

	public $table = 'country';
	public $primary_key = 'id';
	public $relation_tables = [
		[
			'name'		=> 'country_translation',
			'column'	=> 'country_id',
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

	// public function get_tour_to_country($select, $where)
	// {
	// 	$this->db->select($select);
	// 	$this->db->from('wc_tour_to_country');
	// 	$this->db->where($where);

	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }

	// public function get_country_by_tour_id($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('wc_tour_to_country pc');
	// 	$this->db->join('wc_tour_categories p', 'p.id = pc.country_id','inner');
	// 	$this->db->where('pc.tour_id',$id);
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0)
	// 	{
	// 		return $query->result_array();
	// 	}

	// 	return false;
	// }

	// public function get_tour_by_country_id($where)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('wc_tour_to_country');
	// 	$this->db->where($where);
	// 	$this->db->join('wc_tours', 'wc_tours.id = wc_tour_to_country.tour_id');
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

	public function get_tour_to_cc($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_tour_to_city');
		$this->db->where($where);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}

	public function insert_hotel_to_cc($data)
	{
		$this->db->insert('wc_hotel_to_cc', $data);
	}

	public function delete_hotel_to_cc($id)
	{
		$this->db->delete('wc_hotel_to_cc', ['hotel_id' => $id]);
	}

	public function get_hotel_to_cc($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_hotel_to_cc');
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