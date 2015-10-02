<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();
// Models
require_once(dirname(dirname(__FILE__)) . '/models/repository.php');
require_once(dirname(dirname(__FILE__)) . '/models/destination.php');
require_once(dirname(dirname(__FILE__)) . '/models/reservation.php');
require_once(dirname(dirname(__FILE__)) . '/models/user.php');
// Controllers
require_once(dirname(dirname(__FILE__)) . '/controllers/core.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/page.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/destinations.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/admin_destinations.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/reservations.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/admin_reservations.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/contact.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/logger.php');
require_once(dirname(dirname(__FILE__)) . '/controllers/error_404.php');
// Helpers
require_once(dirname(dirname(__FILE__)) . '/includes/helpers.php');
// Engines
require_once(dirname(dirname(__FILE__)) . '/includes/route.php');

// Initialize the Core controller
$core = new \Tourizm\Controller\Core();
