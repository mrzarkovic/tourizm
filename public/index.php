<?php

   define( 'BASEPATH', str_replace( "\\", "/", "../system" ) );

   // Include startup scripts
   require_once( BASEPATH . '/includes/start-up.php' );
   // Include routes
   require_once( BASEPATH . '/includes/routes.php' );
   // Exception handling
   set_exception_handler( 'exception_handler' );

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Tourizm | Prezentacija turističke agencije </title>
      <link rel="stylesheet" type="text/css" href="/css/style.css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   </head>
   <body>
      <?php
         require_once( BASEPATH . '/views/partials/header.php' );

         function exception_handler( $exception )
         {
           $msg = $exception->getMessage();
           include(BASEPATH .' /views/404.php');
         }

         $route->run();

         require_once( BASEPATH . '/views/partials/footer.php' );
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
