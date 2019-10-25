<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * link the css files 
 * 
 * @param array $array
 * @return print css links
 */

if (!function_exists('load_css'))
{
    function load_css(array $array)
    {
    	foreach ($array as $uri)
        {
        	echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri). "' />";
        }
    }
}

/**
 * link the javascript files 
 *
 * @param array $array
 * @return print js links
 */

if (!function_exists('load_js'))
{
    function load_js(array $array)
    {
    	foreach ($array as $uri)
    	{
    		echo "<script type='text/javascript'  src='" . base_url($uri) . "?v=$version'></script>";
    	}

    }
    

}
