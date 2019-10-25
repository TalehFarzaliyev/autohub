<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends Main_Model {

	public $table = 'menu';
	public $primary_key = 'id';
	public $relation_tables = [];
	public $protected = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function getBlock($id)
	{
			$query = $this->db->query("SELECT * FROM ".$this->table." WHERE id=$id");
			return $query->result_array();
	}
	public function insertMenu($data)
	{
			return $this->db->insert($this->table, $data);
	}
	public function updateMenu($data,$id)
	{
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
	}

	public function all()
	{
      return $this->db->get("menus")->result_array();
	}

	public function get_items($menu_id, $lang_id, $status)
	{
            $this->db->where('menu_items.menu_id', $menu_id);
            $this->db->where('menu_items_translation.lang_id', $lang_id);
            $this->db->where('menu_items.status', $status);
						$this->db->join('menu_items_translation', 'menu_items.id = menu_items_translation.menu_items_id');
            return $this->db->get('menu_items')->result_array();
	}

}
