<?php
   include_once("includes/start-up.php");

   $route = new Route();
   $route->add('/', 'home@Page');
   $route->add('/ponude', 'index@Destinations');
   $route->add('/ponude/(:num)', 'index@Destinations');
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

   // Exception handling
   set_exception_handler('exception_handler');

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Tourizm | Prezentacija turističke agencije</title>
      <link rel="stylesheet" type="text/css" href="/css/style.css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   </head>
   <body>
      <?php
         include('includes/header.php');

         function exception_handler( $exception )
         {
           $msg = $exception->getMessage();
           include('views/404.php');
         }

         $route->run();

         include('includes/footer.php');
      ?>
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="/js/main.js"></script>
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
   </body>
</html>
