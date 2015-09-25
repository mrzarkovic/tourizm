<?php

include('../includes/app.class.php');
$app = new App();

if ( !$app->user_logged_in() )
{
  header('Location: ../login.php');
}
else
{
  if ( !empty( $_GET ) && isset( $_GET['id'] ) )
  {
    $id = $_GET['id'];
    $app->delete_reservation( $id );
  }

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
      <?php include('../includes/header.php') ?>
      <section class="main content">
        <h1>Brisanje rezervacije</h1>
        <p class="notice">
          <?php echo $app->msg_to_user; ?>
        </p>
        <span class="goback" onclick="goBack();">« Nazad</span>
      </section>
      <?php include('../includes/footer.php') ?>
    </body>
  </html>
  <?php
}

?>
