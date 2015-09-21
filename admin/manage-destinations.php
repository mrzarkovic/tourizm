<?php
  include('../includes/helpers.php');

  if (!user_logged_in())
  {
    header('Location: ../login.php');
  }
  else
  {

    $destinations = get_destinations();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Manage Destinations</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <?php include('../includes/header.php') ?>
    <section class="main content">
      <h1>Destinations list</h1>
      <ul class="admin-submenu">
        <li>
          <a href="add-destination.php">Add Destination</a>
        </li>
      </ul>
      <div class="admin-destinations">
        <?php
        if ($destinations)
        {
         foreach ($destinations as $destination)
         { ?>
          <div class="destination">
            <h1><?php echo $destination->name; ?></h1>
            <p><?php echo $destination->description; ?></p>
            <div class="destination-price">
              <?php echo $destination->price; ?>
            </div>
            <div class="control">
              <a href="edit-destination.php?id=<?php echo $destination->id; ?>">Izmeni</a>
              <a href="delete-destination.php?id=<?php echo $destination->id; ?>">Obriši</a>
            </div>
          </div>
          <!-- end of .destination -->
        <?php
        }
      }
      else
      {
      ?>
      <p>
        Nema destinacija u bazi.
      </p>
      <?php
      }
      ?>
      </div>
    </section>
    <?php include('../includes/footer.php') ?>
  </body>
</html>
<?php
  }
?>
