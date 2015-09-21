<?php

  if (!empty($_GET) && isset($_GET['id']))
  {

  include_once('includes/helpers.php');

  $id = $_GET['id'];
  $destination = get_destination($id);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | <?php echo $destination->name; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section class="main content">
      <div class="destination">
        <?php if ($destination) : ?>
          <h1><?php echo $destination->name; ?></h1>
          <p>
            <img src="img/destinations/<?php echo $destination->image_path; ?>" width="400"/>
            <?php echo $destination->description; ?>
          </p>
          <a href="make-reservation.php?id=<?php echo $destination->id; ?>">Rezerviši</a>
        <?php else : ?>
          <p>
            Destinacija ne postoji.
          </p>
        <?php endif; ?>
      </div>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
<?php
}
else
{
  header("Location: index.php");
}
?>
