<?php
  include('../includes/helpers.php');

  if (!user_logged_in())
  {
    header('Location: ../login.php');
  }
  else
  {

    $reservations = get_reservations();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Manage Reservations</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <?php include('../includes/header.php') ?>
    <section class="main content">
      <h1>Sve rezervacije</h1>
      <div class="reservations">
        <?php
        if ($reservations)
        {
        ?>
        <ol>
        <?php
        foreach ($reservations as $reservation)
        {
          $destination = get_destination($reservation->destination_id);
        ?>
          <li>
            <b><?php echo $destination->name; ?></b> <?php echo $reservation->customer_name; ?> (<?php echo $reservation->customer_phone; ?>, <a href="mailto:<?php echo $reservation->customer_email; ?>"><?php echo $reservation->customer_email; ?></a>)
          </li>
        <?php
        }
        ?>
        </ol>
        <?php
        }
        else
        {
        ?>
        <p>
          Nema rezervacija.
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
