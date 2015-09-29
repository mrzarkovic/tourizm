<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'].'tourizm/includes/app.class.php');
$app = new App();
include($_SERVER['DOCUMENT_ROOT'].'tourizm/models/destination.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/models/reservation.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/controllers/core.php');
$core = new Core();
include($_SERVER['DOCUMENT_ROOT'].'tourizm/controllers/page.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/controllers/destinations.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/controllers/reservations.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/controllers/contact.php');
include($_SERVER['DOCUMENT_ROOT'].'tourizm/includes/helpers.php');
