<?php
  include('../includes/app.class.php');
  $app = new App();

  if ( !$app->user_logged_in() )
  {
    header('Location: ../login.php');
  }
  else
  {
    $destinations = $app->get_destinations();

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
    <?php include('../includes/header.php') ?>
    <section class="main content">
      <h1>Lista destinacija</h1>
      <ul class="admin-submenu clearfix">
        <li>
          <a href="add-destination.php">Dodaj destinaciju</a>
        </li>
      </ul>
      <div class="admin-destinations">
        <?php
        if ( $destinations )
        {
         foreach ( $destinations as $destination )
         { ?>
          <div class="destination clearfix">
            <h1><?php echo $destination->name; ?> <small>još <span class="bold"><?php echo $app->get_reservatons_left( $destination ); ?></span> aranžmana (<time><?php echo $app->get_pretty_date( $destination->date_from ); ?></time> - <time><?php echo $app->get_pretty_date( $destination->date_to ); ?></time>)</small></h1>
            <p><?php echo $app->get_excerpt( $destination->description ); ?></p>
            <div class="control">
              <a href="edit-destination.php?id=<?php echo $destination->id; ?>">Izmeni</a>
              <a href="delete-destination.php?id=<?php echo $destination->id; ?>" data-role="del">Obriši</a>
            </div>
            <div class="destination-price">
              <?php echo $destination->price; ?> RSD
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
