<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$core->add_route('/', 'home@Page');
$core->add_route('/ponude', 'listing@Destinations');
$core->add_route('/ponude/(:num)', 'listing@Destinations');
$core->add_route('/kontakt', 'index@Contact');
$core->add_route('/ponuda/(:num)', 'show@Destinations');
$core->add_route('/rezervisi', 'index@Reservations');
$core->add_route('/rezervisi/(:num)', 'index@Reservations');
$core->add_route('/login', 'login@Logger');
$core->add_route('/admin/logout', 'logout@Logger');
$core->add_route('/admin/manage-destinations', 'manage@Admin_destinations');
$core->add_route('/admin/add-destination', 'add@Admin_destinations');
$core->add_route('/admin/edit-destination', 'edit@Admin_destinations');
$core->add_route('/admin/edit-destination/(:num)', 'edit@Admin_destinations');
$core->add_route('/admin/delete-destination/(:num)', 'delete@Admin_destinations');
$core->add_route('/admin/manage-reservations', 'manage@Admin_reservations');
$core->add_route('/admin/delete-reservation/(:num)', 'delete@Admin_reservations');
