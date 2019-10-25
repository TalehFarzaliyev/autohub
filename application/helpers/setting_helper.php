<?php

if(!function_exists('get_setting'))
{
    function get_setting($key = false, $custom = false)
    {
        $CI =& get_instance();
        
        if($key)
        {
            $CI->db->where('key', $key);
            $query = $CI->db->get('settings');
            if($query->num_rows() == 1)
            {
                $setting = $query->row();
                if($setting->json == 1)
                {
                    if($custom)
                    {
                        $json = json_decode($setting->value);
                        return (isset($json->$custom)) ? $json->$custom : 'UNKNOWN';
                    }
                    else
                    {
                        return json_decode($setting->value);
                    }
                }
                else
                {
                    return $setting->value;
                }
            }
            return false;
        }
        return false;
        
    }
}