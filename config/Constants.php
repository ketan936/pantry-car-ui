<?php 

/* All api routed to be defined under this block */
define('API_HOST','http://52.10.55.210:8080');

define('LOGIN_API_ROUTE','/customers/login');

define('SIGNUP_API_ROUTE','/customers/');

define('USER_DETAIL_ROUTE','/customers/');

define('TOKEN_ROUTE','/customers/get_customer_from_token');

define("PNR_DETAIL_ROUTE","/railways/get_stations_from_pnr/");

define("TRAIN_BETWEEN_LOCATION_ROUTE","/railways/get_trains_between_locations");

define("STATION_BETWEEN_LOCATION_ROUTE","/railways/get_stations_between_locations");

define("VERIFIY_ACCOUNT_ROUTE","/customers/set_customer_verified");

define("RESTAURANT_MENU_API_ROUTE","/restaurants/");

define("GET_RESTAURANT_BY_STATION_API_ROUTE","/restaurants/get_restaurants_by_station/");

/* String constants to be defined under this block */
define("ACCESS_DENIED","access_denied");

define("UPDATE_PASSWORD_RESET_TOKEN_ROUTE",'/customers/');

define("CHANGE_PASSWORD_ROUTE","/customers/");

define("GET_RESTAURANT_DETAILS_ROUTE","/restaurants/");

define('HTTP_URL_REPLACE', 1);        // Replace every part of the first URL when there's one of the second URL

define('HTTP_URL_JOIN_PATH', 2);      // Join relative paths

define('HTTP_URL_JOIN_QUERY', 4);     // Join query strings

define('HTTP_URL_STRIP_USER', 8);     // Strip any user authentication information

define('HTTP_URL_STRIP_PASS', 16);      // Strip any password authentication information

define('HTTP_URL_STRIP_AUTH', 32);      // Strip any authentication information

define('HTTP_URL_STRIP_PORT', 64);      // Strip explicit port numbers

define('HTTP_URL_STRIP_PATH', 128);     // Strip complete path

define('HTTP_URL_STRIP_QUERY', 256);    // Strip query string

define('HTTP_URL_STRIP_FRAGMENT', 512);   // Strip any fragments (#identifier)

define('HTTP_URL_STRIP_ALL', 1024);
