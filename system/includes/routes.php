<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route = new Route();

$route->add('/', 'home@Page');
$route->add('/ponude', 'listing@Destinations');
$route->add('/ponude/(:num)', 'listing@Destinations');
$route->add('/kontakt', 'index@Contact');
$route->add('/ponuda/(:num)', 'show@Destinations');
$route->add('/rezervisi', 'index@Reservations');
$route->add('/rezervisi/(:num)', 'index@Reservations');
$route->add('/login', 'login@Logger');
$route->add('/admin/logout', 'logout@Logger');
$route->add('/admin/manage-destinations', 'manage@Destinations');
$route->add('/admin/add-destination', 'add@Destinations');
$route->add('/admin/edit-destination', 'edit@Destinations');
$route->add('/admin/edit-destination/(:num)', 'edit@Destinations');
$route->add('/admin/delete-destination/(:num)', 'delete@Destinations');
$route->add('/admin/manage-reservations', 'manage@Reservations');
$route->add('/admin/delete-reservation/(:num)', 'delete@Reservations');
