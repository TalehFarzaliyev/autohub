<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends Main_Model {

	public $table = 'tour_booking';
	//public $table_image = 'wc_tour_images';
	public $primary_key = 'id';
	// public $relation_tables = [
	// 	[
	// 		'name'		=> 'tour_translation',
	// 		'column'	=> 'tour_id',
	// 		'delete'	=> TRUE,
	// 	]
	// ];

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

	public function add_book_Request($data)
	{
		$this->db->insert('wc_tour_booking',$data);
		return $this->db->insert_id();
	}
	public function delete_book_Request($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('wc_tour_booking');
	}
	public function get_Book_Requests($data)
	{
		$this->db->select('tb.id,t.image,tct.name,tb.email,tb.phone,tb.created_day,tb.status');
		$this->db->from('wc_tour_booking tb');
		$this->db->join('wc_tours t', 'tb.tour_id=t.id', 'inner');
		$this->db->join('wc_tour_translation tct' ,'t.id=tct.tour_id','inner');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_rows($data)
	{
		//$this->db->select('tb.*,t.*');
		$this->db->select('COUNT(tb.id) as count');
		$this->db->from('wc_tour_booking tb');
		$this->db->join('wc_tours t', 'tb.tour_id=t.id', 'inner');
		$this->db->join('wc_tour_translation tct' ,'t.id=tct.tour_id','inner');
		$this->db->where($data);
		$query = $this->db->get();
		//return $query->num_rows();
		$row = $query->row();	
		return $row->count;
	}

	public function get_Hotel_Requests($data)
	{
		$this->db->select('t.*,tb.*,tct.name');
		$this->db->from('wc_hotel_booking tb');
		$this->db->join('wc_hotels t', 'tb.hotel_id=t.id', 'inner');
		$this->db->join('wc_hotel_translation tct' ,'t.id=tct.hotel_id','inner');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_rows_hotel($data)
	{
		$this->db->select('t.*,tb.*');
		$this->db->from('wc_hotel_booking tb');
		$this->db->join('wc_hotels t', 'tb.hotel_id=t.id', 'inner');
		$this->db->join('wc_hotel_translation tct' ,'t.id=tct.hotel_id','inner');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function callback_get_tour($data, $params = [])
	{
		if($data){
			$this->db->select('name');
			$this->db->from('wc_tour_translation');
			$this->db->where(['tour_id'=>$data,'lang_id'=>$params['lang_id']]);
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return $query->result_array()[0]['name'];
			}

		}
		return false;
	}
}