<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// EANSLUG => properties
$route['default_controller'] = "home";
$route['404_override'] = 'home';
$route['translate_uri_dashes'] = FALSE;
$route['supplier-register'] = 'home/supplier_register';
$route[str_replace("/", "",EANSLUG)] = 'Ean';
$route[EANSLUG.'loadMore'] = 'Ean/loadMore';
$route[EANSLUG.'listings/(:any)'] = 'Ean/listings/$1';
$route[EANSLUG.'search'] = 'Ean/search';
$route[EANSLUG.'reservation/?(:any)?'] = 'Ean/reservation/$1';
$route[str_replace("/", "",EANSLUG)."/?(:any)?"] = 'Ean/index/$1';
$route[EANSLUG.'itin'] = 'Ean/itin';
$route[EANSLUG.'hotel/(:any)/(:any)/?(:any)'] = 'Ean/hotel/$1/$2/$3';
$route['car'] = 'Cartrawler';
$route['flightst'] = 'Travelstart';
$route['air'] = 'Travelpayouts';
$route['flightsw'] = 'Wegoflights';
$route['hotelsc'] = 'Hotelscombined';
$route['sitemap\.xml'] = "Sitemap";
$route['getCities'] = "Home/getCities";
$route['visa'] = 'Ivisa';
// Disable to access admin page
//$route['admin'] = '404';
// END
$route['admin/flights'] = 'flights/flightsback/index'; // For index page
$route['admin/flights/(.*)'] = 'flights/flightsback/$1'; // For index page
$route['admin/flights/ajaxController/(.*)'] = 'flights/AjaxController/$1';
// Travelport Flight Module Routing
// Client side
$route['flight'] = 'travelport_flight/flight/index'; // For index page
$route['flight/search/(.*)'] = 'travelport_flight/flight/index/$1'; // For index page
$route['flight/cart'] = 'travelport_flight/cart/checkout';
$route['flight/cart/(.*)'] = 'travelport_flight/cart/$1';
$route['flight/invoice'] = 'travelport_flight/invoice/index';
$route['flight/invoice/(.*)'] = 'travelport_flight/invoice/$1';
$route['flight/ajaxController/(.*)'] = 'travelport_flight/AjaxController/$1';
$route['flight/(.*)'] = 'travelport_flight/flight/$1';
// Admin side
$route['admin/flight'] = 'travelport_flight/flightback/index'; // For index page
$route['admin/travelport_flight'] = 'travelport_flight/flightback/index'; // For index page
$route['admin/flight/(.*)'] = 'travelport_flight/flightback/$1';
$route['admin/travelport_flight/ajaxController/(.*)'] = 'travelport_flight/AjaxController/$1';
$route['admin/travelport_flight/(.*)'] = 'travelport_flight/flightback/$1';
// Travelpayout Hotels
$route['tphotels'] = 'travelpayoutshotels/travelpayoutshotels/index';
$route['admin/travelpayoutshotels'] = 'travelpayoutshotels/travelpayoutshotelsback/index'; // For index page
$route['admin/travelpayoutshotels/(.*)'] = 'travelpayoutshotels/travelpayoutshotelsback/$1';