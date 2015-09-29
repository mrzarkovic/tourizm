<?php
include_once("includes/start-up.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
      <?php
         include('includes/header.php');

         $page = new Page();
         $page->login();

         include('includes/footer.php');
      ?>
  </body>
</html>
