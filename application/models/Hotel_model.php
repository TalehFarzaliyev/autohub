<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends Main_Model {

	public $table = 'hotels';
	public $primary_key = 'id';
	public $table_image = 'hotel_images';
	public $protected = [];

	public $relation_tables = [
		[
			'name'		=> 'hotel_translation',
			'column'	=> 'hotel_id',
			'delete'	=> TRUE,
		]
	];
	public function __construct()
	{
		parent::__construct();
	}

	public function get_hotel_translation($select, $where, $sort = false, $limit = false)
	{
		$this->db->select($select);
		$this->db->from('hotel_translation');

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

	public function get_attribute_to_hotel($select, $where, $sort = false ,$limit = false)
	{
		$this->db->select($select);
		$this->db->from('attributes_to_hotel');
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

	public function insert_hotel_translation($data)
	{
		$this->db->insert('hotel_translation',$data);
	}

	public function insert_images($data)
	{
		$this->db->insert($this->table_image,$data);
	}

	public function insert_attribute_to_hotel($data)
	{
		$this->db->insert('attributes_to_hotel',$data);
	}

	public function delete_hotel_translation($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('hotel_translation');
	}

	public function delete_images($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('hotel_images');
	}

	public function delete_attributes($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('attributes_to_hotel');
	}

	public function delete_cc($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('hotel_to_cc');
	}

	public function get_hotel_images($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_image);
		$this->db->where('hotel_id', $id);
		$query = $this->db->get();

		if($query->num_rows())
			return $query->result();
	}

	public function get_images($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$query = $this->db->get('hotel_images');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return false;
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
	public function insert_to_hotel($data)
	{
		$this->db->insert('tour_to_hotel',$data);
	}

	public function delete_tour_hotel($tour_id)
	{
		$this->db->where('tour_id', $tour_id);
		$this->db->delete('tour_to_hotel');
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

	public function get_hotel_in_city($select, $where)
	{
		
		$this->db->select($select);
		$this->db->from('wc_hotel_to_cc');
		$this->db->where($where);
		//$this->db->group_by('hotel_id');

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}
}
