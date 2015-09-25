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
      $app->delete_destination( $id );
  }

  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Tourizm | Delete Destination</title>
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="../js/main.js"></script>
    </head>
    <body>
      <?php include('../includes/header.php') ?>
      <section class="main content">
        <h1>Obriši destinaciju</h1>
        <ul class="admin-submenu clearfix">
          <li>
            <a href="manage-destinations.php">Lista destinacija</a>
          </li>
          <li>
            <a href="add-destination.php">Dodaj destinaciju</a>
          </li>
        </ul>
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
