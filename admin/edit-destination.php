<?php
  include('../includes/helpers.php');

   $msg_to_user = "";
   $id = 0;

  if (!user_logged_in())
  {
    header('Location: ../login.php');
  }
  else
  {


    if (!empty($_GET) && isset($_GET['id']))
    {
     $id = $_GET['id'];
    }
    else if (!empty($_POST))
    {
      $destination_id = $_POST['destination_id'];
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
        $msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
        $conn = connect_to_db();

        $image_path = $_POST['image_path'];

        // Prevent SQL Injection
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $total_quota = $conn->real_escape_string($_POST['total_quota']);
        $price = $conn->real_escape_string($_POST['price']);

        $date_from = new DateTime($_POST['date_from']);
        $date_to = new DateTime($_POST['date_to']);

        $date_from = $date_from->format('Y-m-d H:i:s');
        $date_to = $date_to->format('Y-m-d H:i:s');

        if ($_FILES["image"]["name"])
        {
           $target_dir = "../img/destinations/";
          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $upload_ok = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

          $image_path = basename($_FILES["image"]["name"]);

          // Check if file is image
          $check = getimagesize($_FILES["image"]["tmp_name"]);
          if( $check !== false )
          {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
            {
              $msg_to_user = "Greska prilikom uploadovanja";
            }
          }
          else
          {
              $msg_to_user = "Pogresan fajl.";
          }
        }

        $sql = "UPDATE destinations SET name = '$name', description = '$description', total_quota = '$total_quota', image_path = '$image_path', date_from = '$date_from', date_to = '$date_to', price = '$price' WHERE id = '$destination_id'";

       $result = $conn->query($sql);

       if ($error = $conn->error)
       {
         $msg_to_user = "Došlo je do greske pri čuvanju. " . $error;
       }
       else
       {
         $msg_to_user = "Uspešno ste izmenili destinaciju: " . $name;
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
    <title>Tourizm | Edit Destination: <?php echo $destination->name; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
      $(function() {
          $( "#date_from" ).datepicker({
             dateFormat: "dd-mm-yy"
          });
          $( "#date_to" ).datepicker({
             dateFormat: "dd-mm-yy"
          });
      });
    </script>
  </head>
  <body>
    <?php include('../includes/header.php') ?>
    <section class="main content">
      <?php if ($destination) : ?>
      <h1>Izmeni destinaciju: <?php echo $destination->name; ?></h1>
      <ul class="admin-submenu clearfix">
        <li>
          <a href="manage-destinations.php">Lista destinacija</a>
        </li>
        <li>
          <a href="add-destination.php">Dodaj destinaciju</a>
        </li>
      </ul>
      <p class="notice">
        <?php echo $msg_to_user; ?>
      </p>
      <form action="edit-destination.php" method="post" enctype="multipart/form-data">
         <input type="hidden" name="destination_id" value="<?php echo $destination->id; ?>">
         <input type="hidden" name="image_path" value="<?php echo $destination->image_path; ?>"/>
        <div class="form-field">
          <label for="name">Naslov:</label>
          <input type="text" name="name" id="name" value="<?php echo $destination->name; ?>" />
        </div>
        <div class="form-field">
          <label for="description">Opis:</label>
          <textarea name="description" id="description"><?php echo $destination->description; ?></textarea>
        </div>
        <div class="form-field">
          <label for="image">Fotografija:</label>
          <div class="image-preview"><img src="../img/destinations/<?php echo $destination->image_path;?>"/></div>
          <input type="file" name="image" id="image">
        </div>
        <div class="form-field">
          <label for="total_quota">Ukupno aranžmana:</label>
          <input type="text" name="total_quota" id="total_quota" value="<?php echo $destination->total_quota; ?>"/>
        </div>
        <div class="form-field">
           <label for="date_from">Datum od:</label>
           <input type="text" name="date_from" id="date_from" value="<?php echo $destination->date_from; ?>">
        </div>
        <div class="form-field">
           <label for="date_to">Datum od:</label>
           <input type="text" name="date_to" id="date_to" value="<?php echo $destination->date_to; ?>">
        </div>
        <div class="form-field">
           <label for="price">Cena:</label>
           <input type="text" name="price" id="price" value="<?php echo $destination->price; ?>"> RSD
        </div>
        <div class="form-field">
          <input type="submit" name="submit" value="Sačuvaj izmene" />
        </div>
      </form>
      <?php else : ?>
         <p class="notice">Ne postojeća destinacija.</p>
      <?php endif; ?>
    </section>
    <?php include('../includes/footer.php') ?>
  </body>
</html>
<?php
  }
?>
