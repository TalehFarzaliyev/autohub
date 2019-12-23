<?php

//if(!function_exists('get_menu_by_id'))
//{
//    function get_menu_by_id($id = false)
//    {
//        $CI =& get_instance();
//        $CI->load->library('menu_generator');
//        $CI->load->model("Menu_model");
//		$CI->load->model("Menu_items_model", "menu_item");
//
//        if($id)
//        {
//            $CI->db->where('id', $id);
//            $CI->db->where('status', 1);
//            $query = $CI->db->get('menu');
//            if($query->num_rows() == 1)
//            {
//                $menu_row   = $query->row();
//                $items      = $CI->Menu_model->get_items($menu_row->id, $CI->data['current_lang_id'], 1);
//                $CI->menu_generator->set_items($items);
//
//                $config["nav_tag_open"]          = '<ul class="nav navbar-nav">';
//                $config["nav_tag_close"]         = '</ul>';
//                $config["item_tag_open"]         = '<li>';
//                $config["item_tag_close"]        = '</li>';
//                $config["parent_tag_open"]       = '<li class="dropdown">';
//                $config["parent_tag_close"]      = '</li>';
//                $config["parent_anchor_tag"]     = '<a href="%s" class="dropdown-toggle category09" data-toggle="dropdown">%s<span class="pe-7s-angle-down"></span></a>';
//                $config["children_tag_open"]     = '<ul class="dropdown-menu menu-slide">';
//                $config["children_tag_close"]    = '</ul>';
//                $config["menu_id"]               = 'id';
//                $config["menu_label"]            = 'name';
//                $config["menu_key"]              = 'slug';
//                $config["menu_parent"]           = 'parent';
//                $config["menu_order"]            = 'order';
//
//                $CI->menu_generator->initialize($config);
//
//                return $CI->menu_generator->render();
//            }
//            return false;
//        }
//        return false;
//    }
//}

if(!function_exists('get_menu_by_name'))
{
    function get_menu_by_name($name = false)
    {
        $CI =& get_instance();
        $CI->load->library('menu_generator');
		$CI->load->model("Menu_items_model", "menu_item");

        if($name)
        {
            $CI->db->where('slug', $name);
            $CI->db->where('status', 1);
            $query = $CI->db->get('menu');
            if($query->num_rows() == 1)
            {
                $menu_row   = $query->row();
                $items      = $CI->Menu_model->get_items($menu_row->id, $CI->data['current_lang_id'], 1);
                $CI->menu_generator->set_items($items);
                print_r($CI->data['current_lang_id']); exit();

                $config["nav_tag_open"]          = '<ul class="nav navbar-nav">';
                $config["nav_tag_close"]         = '</ul>';
                $config["item_tag_open"]         = '<li>';
                $config["item_tag_close"]        = '</li>';
                $config["parent_tag_open"]       = '<li>';
                $config["parent_tag_close"]      = '</li>';
                $config["parent_anchor_tag"]     = '<a  href="%s" class="dropdown-toggle category03" data-toggle="dropdown">%s<span class="pe-7s-angle-down"></span></a>';
                $config["children_tag_open"]     = '<li class="dropdown">';
                $config["children_tag_close"]    = '</li>';
                $config['icon_position']         = 'left';
                $config['menu_icons_list']       = [];
                $config['icon_img_base_url']     = '';
                $config["menu_id"]               = 'id';
                $config["menu_label"]            = 'name';
                $config["menu_key"]              = 'slug';
                $config["menu_parent"]           = 'parent';
                $config["menu_order"]            = 'order';

                $CI->menu_generator->initialize($config);
                return $CI->menu_generator->render();
            }
            return false;
        }
        return false;
    }
}

if(!function_exists('get_menu_by_mobile'))
{
    function get_menu_by_mobile($name = false)
    {
        $CI =& get_instance();
        $CI->load->library('menu_generator');
        $CI->load->model("Menu_items_model", "menu_item");

        if($name)
        {
            $CI->db->where('slug', $name);
            $CI->db->where('status', 1);
            $query = $CI->db->get('menu');
            if($query->num_rows() == 1)
            {
                $menu_row   = $query->row();
                $items      = $CI->Menu_model->get_items($menu_row->id, $CI->data['current_lang_id'], 1);
                $CI->menu_generator->set_items($items);
                print_r($CI->data['current_lang_id']); exit();

                $config["nav_tag_open"]          = '<ul class="nav side-menu">';
                $config["nav_tag_close"]         = '</ul>';
                $config["item_tag_open"]         = '<li>';
                $config["item_tag_close"]        = '</li>';
                $config["parent_tag_open"]       = '<li>';
                $config["parent_tag_close"]      = '</li>';
                $config["parent_anchor_tag"]     = '<a  href="%s" >%s<span class="fa arrow"></span></a>';
                $config["children_tag_open"]     = '<ul class="nav nav-second-level">';
                $config["children_tag_close"]    = '</ul>';
                $config['icon_position']         = 'left';
                $config['menu_icons_list']       = [];
                $config['icon_img_base_url']     = '';
                $config["menu_id"]               = 'id';
                $config["menu_label"]            = 'name';
                $config["menu_key"]              = 'slug';
                $config["menu_parent"]           = 'parent';
                $config["menu_order"]            = 'order';

                $CI->menu_generator->initialize($config);
                return $CI->menu_generator->render();
            }
            return false;
        }
        return false;
    }
}