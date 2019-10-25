<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_category_model extends Main_Model {

	public $table = 'travel_style';
	public $primary_key = 'id';
	public $relation_tables = [
		[
			'name'		=> 'travel_style_translation',
			'column'	=> 'travel_style_id',
			'delete'	=> TRUE,
		]
	];

	public $protected = [];

	public function __construct()
	{	
		parent::__construct();
	}

	public function get_rows($select, $where, $sort = false, $limit = false, $trash = false)
	{
		$this->db->select($select);
		$this->db->from($this->table);
		if(isset($this->relation_tables) && !empty($this->relation_tables))
		{
			foreach ($this->relation_tables as $relation_table)
			{
				$this->db->join($relation_table['name'], $this->table.'.'.$this->primary_key.' = '.$relation_table['name'].'.'.$relation_table['column']);
			}
		}
		$this->db->where($where);
		if($trash)
		{
			$this->db->where('deleted_at !=', NULL);
		}
		else
		{
			$this->db->where('deleted_at', NULL);
		}
		if($limit)
		{
			$this->db->limit($limit['per_page'], ($limit['page']-1)*$limit['per_page']);
		}
		if($sort)
		{
			$this->db->order_by($sort['column'], $sort['order']);
		}
		else
		{
			$this->db->order_by('created_at', 'DESC');
		}

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return false;
	}

	public function insert_tour_to_category($data)
	{
		$this->db->insert('wc_tour_to_category', $data);
	}

	public function delete_tour_to_category($id)
	{
		$this->db->delete('wc_tour_to_category', ['tour_id' => $id]);
	}
	// public function get_category($id,$lang)
	// {
	// 	$this->db->select('name');
	// 	$this->db->from('tour_categories pc');
	// 	$this->db->join('tour_category_translation pct', 'pc.id=pct.tour_category_id');
	// 	$this->db->where('tour_category_id',$id);
	// 	$this->db->where('lang_id',$lang);
	// 	$query = $this->db->get();

	// 	if($query->num_rows()>0)
	// 		return $query->row();
	// 	else
	// 		return false;
	// }

	public function get_tour_to_category($select, $where)
	{
		$this->db->select($select);
		$this->db->from('wc_tour_to_category');
		$this->db->where($where);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}
}