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
    $id = $_POST['destination_id'];

    $msg_to_user = make_reservation( $id );

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
      <div class="date">
         <time><?php echo get_pretty_date($destination->date_from); ?></time> - <time><?php echo get_pretty_date($destination->date_to); ?></time>
      </div>
      <p>Preostalo je još <span class="bold"><?php echo get_reservatons_left($destination); ?></span> aranžmana.</p>
      <p class="notice">
        <?php echo $msg_to_user; ?>
      </p>
      <form action="rezervisi.php" method="post">
        <input type="hidden" name="destination_id" value="<?php echo $destination->id; ?>">
        <div class="form-field">
          <label for="name">Vaše ime:</label>
          <input type="text" name="customer_name" id="name" value="" />
        </div>
        <div class="form-field">
          <label for="phone">Vaš telefon:</label>
          <input type="text" name="customer_phone" id="phone" value="" />
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
