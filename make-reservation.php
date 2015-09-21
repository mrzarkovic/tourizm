<?php
  include_once('includes/helpers.php');
  $destination = "";
  $msg_to_user = "";

  $id = 0;

  if (!empty($_GET) && isset($_GET['id']))
  {
    $id = $_GET['id'];
  }
  else if (!empty($_POST) && isset($_POST['destination_id']))
  {
    $destination_id = $_POST['destination_id'];
    $destination_name = $_POST['destination_name'];

    // Check input
    if ( ($_POST['customer_name'] == '') || ($_POST['customer_email'] == ''))
    {
      $msg_to_user = "Morate popuniti sva polja.";
    }
    else
    {
      $conn = connect_to_db();

      // Prevent SQL Injection
      $customer_name = $conn->real_escape_string($_POST['customer_name']);
      $customer_email = $conn->real_escape_string($_POST['customer_email']);

      $sql = "INSERT INTO reservations (destination_id, customer_name, customer_email) VALUES ('$destination_id', '$customer_name', '$customer_email')";

      $result = $conn->query($sql);

      if ($error = $conn->error)
      {
        $msg_to_user = "Došlo je do greske pri čuvanju rezervacije. " . $error;
      }
      else
      {
        $msg_to_user = "Uspešno ste rezervisali destinaciju: " . $destination_name;
      }

      $conn->close();
    }

    $id = $destination_id;
  }

  $destination = get_destination( $id );
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Rezerviši <?php echo $destination->name; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section class="main content">
      <?php if ($destination) : ?>
      <h1>Rezerviši <?php echo $destination->name; ?></h1>
      <p class="notice">
        <?php echo $msg_to_user; ?>
      </p>
      <form action="make-reservation.php" method="post">
        <input type="hidden" name="destination_id" value="<?php echo $destination->id; ?>">
        <input type="hidden" name="destination_name" value="<?php echo $destination->name; ?>"/>
        <div class="form-field">
          <label for="name">Vaše ime:</label>
          <input type="text" name="customer_name" id="name" value="" />
        </div>
        <div class="form-field">
          <label for="email">Vaš email:</label>
          <input type="email" name="customer_email" id="email" value="" placeholder="npr. vase.ime@primer.rs" />
        </div>
        <div class="form-field">
          <input type="submit" name="submit" value="Rezerviši" />
        </div>
      </form>
      <?php else : ?>
        <p>
          Destinacija ne postoji.
        </p>
      <?php endif; ?>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
