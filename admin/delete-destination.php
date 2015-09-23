<?php

$msg_to_user = "";
include('../includes/helpers.php');

if (!user_logged_in())
{
  header('Location: ../login.php');
}
else
{
  if (!empty($_GET) && isset($_GET['id']))
  {

    $conn = connect_to_db();
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM destinations WHERE id = '$id'";
    $conn->query($sql);

    if ($error = $conn->error)
    {
      $msg_to_user = "Došlo je do greske pri brisanju. " . $error;
    }
    else
    {
      $msg_to_user = "Uspešno ste obrisali destinaciju.";
    }

    $conn->close();
  }

  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Tourizm | Delete Destination</title>
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
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
          <?php echo $msg_to_user; ?>
        </p>
      </section>
      <?php include('../includes/footer.php') ?>
    </body>
  </html>
  <?php
}

?>
