<?php

include_once("../includes/start-up.php");

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Tourizm | Add New Destination</title>
   <link rel="stylesheet" type="text/css" href="../css/style.css" />
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script>
      $(function() {
         $( "#date_from" ).datepicker({
            dateFormat: "dd-mm-yy"
         });
         $( "#date_to" ).datepicker({
            dateFormat: "dd-mm-yy"
         });
      });
   </script>
</head>
<body>
   <?php
      include('../includes/header.php');

      $destinations = new Destinations();
      $destinations->add();

      include('../includes/footer.php');
   ?>
</body>
</html>
