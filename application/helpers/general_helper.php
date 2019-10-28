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

if (!function_exists('textLimit'))
{
    function textLimit($expression,$max)
    {
        $expression = trim(strip_tags($expression));
        if($max > strlen($expression))
        {
            return $expression;
        }
        $return = mb_substr($expression,0,($max-3),'UTF-8').'...';
        return $return;
    }
}

if (!function_exists('getCleanText'))
{
    function getCleanText($data)
    {
        if(!empty($data)){
            return stripslashes(strip_tags(str_replace('"','&quot;',trim($data))));
        }
    }
}

if (!function_exists('getDateTime'))
{
    function getDatetime($datetime,$params = [])
    {

        $params['type']   = empty($params['type']) ? 'datetime': $params['type'];

        $params['month']  = empty($params['month']) ? 'yes': $params['month'];

        $params['combine']= empty($params['combine']) ? ' ' : $params['combine'];

        if(!strpos($datetime,'-'))
        {
            $datetime = date('Y-m-d H:i:s', $datetime);
        }

        if(strpos($datetime,':'))
        {
            preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$datetime, $matches);
        }else{
            preg_match('/(\d{4})-(\d{2})-(\d{2})/',$datetime, $matches);
            $params['type'] = 'date';
        }

        $month = $params['month'] == 'yes' ? Yii::$app->params['months'][$matches[2]-1] : $matches[2];

        if($params['type'] == 'datetime')
        {
            if(isset($matches[4]) && isset($matches[5]))
            {
                return $matches[3].$params['combine'].$month.'-'.$matches[1].' '.$matches[4].':'.$matches[5];
            }
        }

        if($params['type'] == 'date')
        {
            return intval($matches[3]).$params['combine'].$month.$params['combine'].$matches[1];
        }

        if($params['type'] == 'time')
        {
            return $matches[4].':'.$matches[5];
        }

    }
}
