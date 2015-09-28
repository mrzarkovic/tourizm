<?php
include('../includes/app.class.php');
$app = new App();

include('../includes/destination.class.php');
$destination = new Destination();

if ( !$app->user_logged_in() )
{
   header('Location: ../login.php');
}
else
{

   if ( !empty( $_POST ) )
   {
      $destination->add_destination();
   }
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
      <?php include('../includes/header.php') ?>
      <section class="main content">
         <h1>Dodaj novu destinaciju</h1>
         <ul class="admin-submenu clearfix">
            <li>
               <a href="manage-destinations.php">Lista destinacija</a>
            </li>
         </ul>
         <p class="notice">
            <?php echo $app->msg_to_user; ?>
         </p>
         <form action="add-destination.php" method="post" enctype="multipart/form-data">
            <div class="form-field">
               <label for="name">Naslov:</label>
               <input type="text" name="name" id="name" />
            </div>
            <div class="form-field">
               <label for="description">Opis:</label>
               <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-field">
               <label for="image">Fotografija:</label>
               <input type="file" name="image" id="image">
            </div>
            <div class="form-field">
               <label for="total_quota">Ukupno aranžmana:</label>
               <input type="text" name="total_quota" id="total_quota" />
            </div>
            <div class="form-field">
               <label for="date_from">Datum od:</label>
               <input type="text" name="date_from" id="date_from">
            </div>
            <div class="form-field">
               <label for="date_to">Datum od:</label>
               <input type="text" name="date_to" id="date_to">
            </div>
            <div class="form-field">
               <label for="price">Cena:</label>
               <input type="text" name="price" id="price"> RSD
            </div>
            <div class="form-field">
               <input type="submit" name="submit" value="Dodaj destinaciju" />
            </div>
         </form>
      </section>
      <?php include('../includes/footer.php') ?>
   </body>
   </html>
   <?php
}
?>
