<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends Main_Model {

	public $table = 'users';
	public $primary_key = 'id';

	public function __construct()
	{	
		parent::__construct();
	}

	public function get_user_group($select = '*', $where)
	{
		$this->db->select($select);
		$this->db->from('wc_user_to_group');

		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return false;
	}

	public function insert_user_to_group($data){

		$this->db->insert('wc_user_to_group',$data);			
	}

	public function save_fcm($id,$data)
	{

		$this->db->where('id', $id);
		$this->db->update('wc_users', $data);			
	}
}