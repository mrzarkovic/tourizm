<?php
  include_once('includes/app.class.php');
  $app = new App();

  // Limit destinations per page
  $per_page = 4;

  if (!empty($_GET['page']))
  {
     // Get the current page
     $page = (int) $_GET['page'] - 1;
  }
  else
  {
     $page = 0;
  }

  $start = $per_page * $page;
  $destinations = $app->get_destinations($per_page, $start);

  $destinations_count = count($app->get_destinations());
  $max_page = ceil($destinations_count / $per_page);

  if (!empty($_POST['search']))
  {
      $keyword = $_POST['search'];
      $destinations = $app->find_destinations( $keyword );
  }

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
      <h1>Sve ponude</h1>
      <div class="destinations clearfix">
         <div class="search">
            <form action="ponude.php" method="post">
               <label for="search">Pretraga: </label>
               <input type="text" name="search" placeholder="npr. Jamajka">
               <input type="submit" name="submit" value="Traži">
            </form>
         </div>
        <?php
        if ($destinations)
        {
           $i = 0;
         foreach ($destinations as $destination)
         {
           ?>
            <div class="destination">
              <div class="destination-image">
                <img src="img/destinations/<?php echo $destination->image_path; ?>" width="200"/>
              </div>
              <h1><?php echo $destination->name; ?></h1>
              <div class="date">
                 <time><?php echo $app->get_pretty_date($destination->date_from); ?></time> - <time><?php echo $app->get_pretty_date($destination->date_to); ?></time>
              </div>
              <p><?php echo $app->get_excerpt($destination->description); ?></p>
              <div class="destination-price">
                <?php echo $destination->price; ?> RSD
              </div>
              <a href="ponuda.php?id=<?php echo $destination->id; ?>" class="see-more">Pogledajte ponudu</a>
            </div>
            <!-- end of .destination -->
          <?php
            $i++;
            if ( $i % 4 == 0 )
               echo '<div class="clearfix"></div>';
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
      <?php if( empty( $_POST['search'] ) ) : ?>
      <div class="pagination">
         <ul class="clearfix">
            <?php if ($page > 0 ) : ?>
            <li>
               <a href="?page=<?php echo $page; ?>">« Prethodna</a>
            </li>
            <?php endif; ?>
            <?php if ($page + 1 < $max_page) : ?>
            <li>
               <a href="?page=<?php echo $page + 2; ?>">Sledeća »</a>
            </li>
            <?php endif; ?>
         </ul>
      </div>
      <?php endif; ?>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
