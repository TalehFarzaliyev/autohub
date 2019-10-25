<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends Main_Model {

	public $table = 'gallery';
	public $primary_key = 'id';

	public $protected = [];

	public function __construct()
	{	
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

	public function get_alls()
	{
		$this->db->select('*');
		$this->db->from('wc_gallery');
		$this->db->where('status', 1);
		$this->db->where('deleted_at',NULL);
		$this->db->limit(8);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_object();
	}
}