<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_items_model extends Main_Model
{
    public $table = 'menu_items';
    public $primary_key = 'id';
    public $relation_tables = [
        [
            'name'    => 'menu_items_translation',
            'column'	=> 'menu_items_id',
            'delete'	=> TRUE,
        ]
    ];

    public $protected = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function get_single_rows($id)
    {
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE id=$id");
        return $query->result_array();
    }

    public function get_single_lang_rows($id)
    {
        $query = $this->db->query("
            SELECT a.status, b.name, b.slug, b.lang_id
            FROM ".$this->table."  a
            INNER JOIN wc_menu_items_translation b ON a.id = b.menu_items_id
            WHERE a.id = $id AND a.status = 1
            ORDER BY a.id DESC
        ");

        return $query->result_array();
    }



    public function get_query_builder()
    {
        $query = $this->db->query("SELECT id, name FROM wc_menu WHERE status=1");
        return $query->result_array();
    }


    public function get_parent_menu()
    {
        $query = $this->db->query("
            SELECT a.id, a.status, b.name, b.slug, b.lang_id
            FROM ".$this->table."  a
            INNER JOIN wc_menu_items_translation b ON a.id = b.menu_items_id
            WHERE a.status = 1 AND b.lang_id = 2 AND parent = 0
            ORDER BY a.id DESC
        ");

        return $query->result_array();
    }

    public function updateMenu($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function deleteLangMenu($id)
    {
        $this->db->delete('wc_menu_items_translation', array('menu_items_id' => $id));
    }

    public function insertMenu($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insertMenuLang($data)
    {
        $this->db->insert('wc_menu_items_translation', $data);
    }

    public function all()
    {
        return $this->db->get("menus")->result_array();
    }

    public function get_items($menu_id, $lang_id, $status)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->where('lang_id', $lang_id);
        $this->db->where('status', $status);
        return $this->db->get('menu_items')->result_array();
    }
}