<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_model extends Main_Model {

	public $table = 'tours';
	public $table_image = 'wc_tour_images';
	public $primary_key = 'id';
	public $relation_tables = [
		[
			'name'		=> 'tour_translation',
			'column'	=> 'tour_id',
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

	public function callback_get_image($data, $params = [])
	{
		if(!empty($data))
		{
			return "<img src='".$this->Model_tool_image->resize($data, $params['width'], $params['height'])."' width='".$params['width']."' height='".$params['height']."'>";
		}
		return;
	}

	public function insert_images($data)
	{
		$this->db->insert($this->table_image,$data);
	}


	public function get_images($tour_id)
	{
		$this->db->where('tour_id', $tour_id);
		$query = $this->db->get('tour_images');
		if($query->num_rows())
		{
			return $query->result_array();
		}
		return false;
	}

	public function get_tour_images($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_image);
		$this->db->where('tour_id', $id);
		$query = $this->db->get();

		if($query->num_rows())
			return $query->result();
	}
	public function delete_tour_translation($id)
	{
		$this->db->where('tour_id', $id);
		$this->db->delete('tour_translation');
	}

	public function delete_images($tour_id)
	{
		$this->db->where('tour_id', $tour_id);
		$this->db->delete('tour_images');
	}
	
	public function insert_program_item($data)
	{
		$this->db->insert('wc_tour_program',$data);
		return $this->db->insert_id();
	}

	public function insert_program_item_translation($data)
	{
		$this->db->insert('tour_program_translation',$data);	
	}
	


	public function get_program_items($select, $where, $sort = false, $limit = false)
	{
		$this->db->select($select);
		$this->db->from('wc_tour_program');

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

	public function get_program_item_translation($select, $where, $sort = false, $limit = false)
	{
		$this->db->select($select);
		$this->db->from('tour_program_translation');

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

	public function delete_slider_items($id)
	{
		$this->db->where('tour_id', $id);
		$this->db->delete('wc_tour_program');
	}
	
	public function delete_slider_item_translation($id)
	{
		$this->db->where('program_id', $id);
		$this->db->delete('tour_program_translation');
	}
	public function get_Tours($data)
	{  
		$this->db->distinct('t.id');
		$this->db->select('t.*, tct.*'); 
		$this->db->from('wc_tour_to_category tc');
		$this->db->join('wc_tours t', 'tc.tour_id=t.id', 'inner');
		$this->db->join('wc_tour_to_city cc', 'cc.tour_id=t.id', 'inner');
		$this->db->join('wc_tour_translation tct' ,'t.id=tct.tour_id','inner');
		$this->db->where($data);
		$this->db->order_by('t.id','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}



	
}