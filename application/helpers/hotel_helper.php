<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('generate_star_html'))
{
	function generate_star_html($starCount, $returnIcon = false)
	{
		$starElements = null;
		$activeStarHtmlElement = ($returnIcon) ? '<i class="reserve-fill-star"></i>' : '<img src="'.base_url('templates/default/assets/img/star.png').'" alt="">';
		$unActiveStarHtmlElement = ($returnIcon) ? '<i class="reserve-fill-star empty-star"></i>' : '<span><img src="'.base_url('templates/default/assets/img/star.png').'" alt=""></span>';
		$activeStar = $starCount;
		$unActiveStar = 5 - $starCount;
		for ($x = 0; $x < $activeStar; $x++) {
			$starElements .= $activeStarHtmlElement;
		}
		for ($x = 0; $x < $unActiveStar; $x++) {
			$starElements .= $unActiveStarHtmlElement;
		}
		echo $starElements;
	}
}

if (!function_exists('dd'))
{
	function dd($args)
	{
		var_dump($args); die();
	}
}
