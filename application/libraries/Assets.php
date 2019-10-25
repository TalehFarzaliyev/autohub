<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets{

	public function load_js(array $array)
    {
    	$scripts = '';
    	foreach ($array as $uri)
    	{
    		$scripts .= "<script type='text/javascript' src='" . base_url($uri) . "'></script>\n";
    	}

    	return $scripts;

    }

    public function load_css(array $array)
    {
    	$links = '';
    	foreach ($array as $uri)
        {
        	$links .= "<link rel='stylesheet' type='text/css' href='" . base_url($uri). "' />\n";
        }

        return $links;
    }

    public function load_script($data)
    {
        $sc = "<script type='text/javascript'>".$data."</script>";
        return $sc;
    }

}
