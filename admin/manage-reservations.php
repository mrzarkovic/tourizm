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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="../js/main.js"></script>
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
            <b><?php echo $destination->name; ?></b><br>Ime: <?php echo $reservation->customer_name; ?> | Tel: <?php echo $reservation->customer_phone; ?> |  Email: <a href="mailto:<?php echo $reservation->customer_email; ?>"><?php echo $reservation->customer_email; ?></a>
            <div class="control">
               <a data-role="del" href="delete-reservation.php?id=<?php echo $reservation->id; ?>">obriši</a>
            </div>
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
