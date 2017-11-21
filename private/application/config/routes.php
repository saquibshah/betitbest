<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

if (TARGET_WEBSITE == 'livescores') {
    $route['default_controller'] = 'livescores';
    $route['^livescores/(en|de)/api/app_stats_service/(:any)'] = 'api/app_stats_service/$1';
    $route['^livescores/(en|de)/api/app_stats_service'] = 'api/app_stats_service';
    $route['^livescores/[a-z]{2}$'] = 'livescores';
    $route['^livescores/[a-z]{2}/(:any)'] = 'livescores';
    $route['^livescores/backend'] = 'backend/home';
    $route['^livescores/backend/(:any)'] = 'backend/$1';
    $route['404_override'] = '';
}

if (TARGET_WEBSITE == "sportsnews") {
    $route['default_controller'] = 'livescores';
	$route['^sportsnews/(en|de)/api/app_news_service/(:any)'] = 'api/app_news_service/$1';
	$route['^sportsnews/(en|de)/api/euro_news_service/(:any)'] = 'api/euro_news_service/$1';
	$route['^sportsnews/(en|de)/api/euro_news_service_new/(:any)'] = 'api/euro_news_service_new/$1';
    $route['^sportsnews/(en|de)/pages/(:any)'] = 'content/$1';
    $route['^sportsnews/(en|de)/(:any)'] = 'home';
    $route['^sportsnews/backend'] = 'backend/home';
    $route['^sportsnews/backend/(:any)'] = 'backend/$1';
    $route['^sportsnews/youtube_importer'] = 'youtube_importer';
    $route['^sportsnews/youtube_importer/(:any)'] = 'youtube_importer/$1';
    $route['404_override'] = '';
}


/* End of file routes.php */
/* Location: ./application/config/routes.php */