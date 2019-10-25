<?php

if(!function_exists('trans'))
{
    function translate($key = false, $common = false)
    {
        $CI =& get_instance();
        if($key)
        {
            $controller = $CI->controller;
            if($common)
            {
                return $CI->lang->translate('common_'.$key);
            }
            return $CI->lang->translate($controller.'_'.$key);
        }

        return 'undefined';        
        
    }
}