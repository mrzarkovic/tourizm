<?php

if (!empty($_GET) && isset($_GET['id']))
{

   include_once('includes/app.class.php');
   $app = new App();
   include_once('includes/destination.class.php');
   $destination = new Destination();
   $id = $_GET['id'];
   $destination->get_destination( $id );

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
         <div class="single-destination clearfix">
            <?php if ( $destination->name ) : ?>
               <h1><?php echo $destination->name; ?></h1>
               <div class="date">
                  <time><?php echo $destination->date_from->format('d.m.Y'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y'); ?></time>
               </div>
               <p>
                  <img src="img/destinations/<?php echo $destination->image_path; ?>" width="400"/>
                  <?php echo $destination->description; ?>
               </p>
               <div class="destination-price">
                  <?php echo $destination->price; ?> RSD
               </div>
               <a href="rezervisi.php?id=<?php echo $destination->id; ?>">Rezervišite</a>
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
