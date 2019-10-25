<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'home';
$route['404_override'] 			= 'Errors/not_found';
$route['translate_uri_dashes'] 	= FALSE;

$route['admin'] 						= 'admin/dashboard';
$route['^(\w{2})/admin']				= 'admin/dashboard';
$route['admin/(.*)$'] 					= 'admin/$1';
$route['^(\w{2})/admin/(.*)$'] 			= 'admin/$2';

// $route['^(\w{2})/about']				= 'about';
$route['^(\w{2})/azerbaijan']			= 'azerbaijan';
$route['^(\w{2})/contact']				= 'contact';

$route['^(\w{2})/tours']				= 'tour';
$route['^(\w{2})/catalog']				= 'tour/catalog';


$route['tours/book/(:any)']		        = 'tour/booking/$1';
$route['^(\w{2})/tour/book']		    = 'tour/booking_tour';

$route['^(\w{2})/tours/book/(:any)']	= 'tour/booking/$2';
$route['^(\w{2})/tours/all']			= 'tour/all';
$route['tours/(:any)']		        	= 'tour/view/$1';
$route['^(\w{2})/tours/(:any)']			= 'tour/view/$2';

$route['^(\w{2})/hotels']				= 'hotel';
$route['hotels/(:any)']		        	= 'hotel/view/$1';
$route['^(\w{2})/hotels/(:any)']		= 'hotel/view/$2';
$route['^(\w{2})/blog']				    = 'blog';
$route['^(\w{2})/blog/last']			= 'blog/last';
$route['^(\w{2})/services']				= 'service';

$route['blog/(:any)']		        	= 'blog/view/$1';
$route['^(\w{2})/blog/(:any)']			= 'blog/view/$2';


// $route['catalog/ajax'] 					= 'catalog/ajax';
// $route['^(\w{2})/catalog/ajax']			= 'catalog/ajax';

// $route['category/(:any)']		        = 'category/index/$1';
// $route['^(\w{2})/category/(:any)']		= 'category/index/$2';


// $route['tours/(:num)']		        = 'tours/view/$1';
// $route['^(\w{2})/tours/(:num)']		= 'tours/view/$2';

$route['^(\w{2})/authentication/(:any)']= 'authentication/$2';

$route['^(\w{2})/(:any)']				= 'page/index/$2';
$route['^(\w{2})$'] 					= $route['default_controller'];
