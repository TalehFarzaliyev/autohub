<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'home';
$route['404_override'] 			= 'Errors/not_found';
$route['translate_uri_dashes'] 	= FALSE;

$route['admin'] 						= 'admin/dashboard';
$route['^(\w{2})/admin']				= 'admin/dashboard';
$route['admin/(.*)$'] 					= 'admin/$1';
$route['^(\w{2})/admin/(.*)$'] 			= 'admin/$2';


$route['kontakt']				        = 'page/contact';
$route['haqqimizda']				    = 'page/about';

$route['^(\w{2})/blog']				    = 'blog';
$route['kateqoriya/(:any)']             = 'blog/category/$1';
$route['^(\w{2})/kateqoriya/(:any)']    = 'blog/category/$2';
$route['xeber/(:any)']		        	= 'blog/view/$1';
$route['^(\w{2})/xeber/(:any)']			= 'blog/view/$2';



$route['^(\w{2})/authentication/(:any)']= 'authentication/$2';

$route['^(\w{2})/(:any)']				= 'page/index/$2';
$route['^(\w{2})$'] 					= $route['default_controller'];
