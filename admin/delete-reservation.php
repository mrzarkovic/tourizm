<?php

include_once("../includes/start-up.php");

?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <title>Tourizm | Delete Reservation</title>
   <link rel="stylesheet" type="text/css" href="../css/style.css" />
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="../js/main.js"></script>
 </head>
 <body>
   <?php
      include('../includes/header.php');

      $reservations = new Reservations();
      $reservations->delete();

      include('../includes/footer.php');
   ?>
 </body>
</html>
