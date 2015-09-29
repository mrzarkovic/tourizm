<?php
  include_once("../includes/start-up.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Manage Destinations</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="../js/main.js"></script>
  </head>
  <body>
    <?php
      include('../includes/header.php');

      $destinations = new Destinations();
      $destinations->manage();

      include('../includes/footer.php');
    ?>
  </body>
</html>
