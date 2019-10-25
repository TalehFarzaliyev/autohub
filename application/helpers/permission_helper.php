<?php

if(!function_exists('check_permission'))
{
    function check_permission($directory = false, $controller = false, $method = false)
    {
        $CI =& get_instance();

        if($directory === false)
            $directory = $CI->directory;
        
        if($controller === false)
            $controller = $CI->controller;
        
        if($method === false)
            $method = $CI->method;

        $CI->db->where('directory',  $directory);
        $CI->db->where('controller', $controller);
        $CI->db->where('method', $method);
        $query = $CI->db->get('permissions');

        if($query->num_rows() > 0)
        {
            $permission = $query->row();
            $permission_id = $permission->id;

            $user_groups = $CI->auth->get_user_groups();
            foreach($user_groups as $user_group)
            {
                $CI->db->where('group_id', $user_group->group_id);
                $CI->db->where('permission_id', $permission_id);
                $query2 = $CI->db->get('permission_to_group');
                if($query2->num_rows() > 0)
                {
                    return true;
                }
            }

        }
        return false;        
    }
}