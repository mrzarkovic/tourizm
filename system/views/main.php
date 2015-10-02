<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php echo $this->title; ?> </title>
      <link rel="stylesheet" type="text/css" href="/css/style.css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   </head>
   <body>
      <?php
         require_once( BASEPATH . '/views/partials/header.php' );

         $this->load_template( $this->template );

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
