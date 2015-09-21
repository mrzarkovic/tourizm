<?php
  include('../includes/helpers.php');

  if (!user_logged_in())
  {
    header('Location: ../login.php');
  }
  else
  {

    $msg_to_user = "";

    if (!empty($_POST))
    {
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
        $msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
        $conn = connect_to_db();

        // Prevent SQL Injection
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $total_quota = $conn->real_escape_string($_POST['total_quota']);

        $target_dir = "../img/destinations/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $upload_ok = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        $image_path = basename($_FILES["image"]["name"]);

        // Check if file is image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if( $check !== false )
        {
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
          {
            $sql = "INSERT INTO destinations (name, description, total_quota, image_path) VALUES ('$name', '$description', '$total_quota', '$image_path')";

            $result = $conn->query($sql);

            if ($error = $conn->error)
            {
              $msg_to_user = "Došlo je do greske pri čuvanju. " . $error;
            }
            else
            {
              $msg_to_user = "Uspešno ste dodali destinaciju: " . $name;
            }
          }
          else
          {
            $msg_to_user = "Greska prilikom uploadovanja";
          }
        }
        else
        {
            $msg_to_user = "Pogresan fajl.";
        }

        $conn->close();
      }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Add New Destination</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <?php include('../includes/header.php') ?>
    <section class="main content">
      <h1>Add new destination</h1>
      <ul class="admin-submenu">
        <li>
          <a href="manage-destinations.php">Destinations list</a>
        </li>
      </ul>
      <p>
        <?php echo $msg_to_user; ?>
      </p>
      <form action="add-destination.php" method="post" enctype="multipart/form-data">
        <div class="form-field">
          <label for="name">Naslov:</label>
          <input type="text" name="name" id="name" />
        </div>
        <div class="form-field">
          <label for="description">Opis:</label>
          <textarea name="description" id="description"></textarea>
        </div>
        <div class="form-field">
          <label for="image">Fotografija:</label>
          <input type="file" name="image" id="image">
        </div>
        <div class="form-field">
          <label for="total_quota">Ukupno aranžmana:</label>
          <input type="text" name="total_quota" id="total_quota" />
        </div>
        <div class="form-field">
          <input type="submit" name="submit" value="Dodaj destianciju" />
        </div>
      </form>
    </section>
    <?php include('../includes/footer.php') ?>
  </body>
</html>
<?php
  }
?>
