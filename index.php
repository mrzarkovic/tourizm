<?php
  include_once('includes/helpers.php');

  $msg_to_user = "";
  $destinations = get_destinations();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Prezentacija turističke agencije</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section class="main content">
      <div class="destinations clearfix">
        <?php
        if ($destinations)
        {
         foreach ($destinations as $destination)
         {
           ?>
            <div class="destination">
              <div class="destination-image">
                <img src="img/destinations/<?php echo $destination->image_path; ?>" width="200"/>
              </div>
              <h1><?php echo $destination->name; ?></h1>
              <p><?php echo $destination->description; ?></p>
              <div class="destination-price">
                <?php echo $destination->price; ?>
              </div>
              <a href="ponuda.php?id=<?php echo $destination->id; ?>" class="see-more">Pogledajte ponudu</a>
            </div>
            <!-- end of .destination -->
          <?php
          }
        }
        else
        {
        ?>
        <p>
          Trenutno nema destinacija.
        </p>
        <?php
        }
        ?>
      </div>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
