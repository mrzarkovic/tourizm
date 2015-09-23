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
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
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
        if ($destinations)
        {
         foreach ($destinations as $destination)
         { ?>
          <div class="destination">
            <h1><?php echo $destination->name; ?> <small>(<time><?php echo get_pretty_date($destination->date_from); ?></time> - <time><?php echo get_pretty_date($destination->date_to); ?></time>)</small></h1>
            <p><?php echo getExcerpt($destination->description); ?></p>
            <div class="destination-price">
              <?php echo $destination->price; ?> RSD
            </div>
            <div class="control">
              <a href="edit-destination.php?id=<?php echo $destination->id; ?>">Izmeni</a>
              <a href="delete-destination.php?id=<?php echo $destination->id; ?>" class="del">Obriši</a>
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
    <script>
    $(document).ready(function(){
     $(".del").click(function(){
       if (!confirm("Da li ste sigurni da želite da obrišete destinaciju?")){
         return false;
       }
     });
   });
    </script>
  </body>
</html>
<?php
  }
?>
