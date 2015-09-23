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
         $price = $conn->real_escape_string($_POST['price']);

         $date_from = new DateTime($_POST['date_from']);
         $date_to = new DateTime($_POST['date_to']);

         $date_from = $date_from->format('Y-m-d H:i:s');
         $date_to = $date_to->format('Y-m-d H:i:s');

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
               $sql = "INSERT INTO destinations (name, description, total_quota, image_path, date_from, date_to, price) VALUES ('$name', '$description', '$total_quota', '$image_path', '$date_from', '$date_to', '$price')";

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
         <h1>Dodaj novu destinaciju</h1>
         <ul class="admin-submenu clearfix">
            <li>
               <a href="manage-destinations.php">Lista destinacija</a>
            </li>
         </ul>
         <p class="notice">
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
               <label for="date_from">Datum od:</label>
               <input type="text" name="date_from" id="date_from">
            </div>
            <div class="form-field">
               <label for="date_to">Datum od:</label>
               <input type="text" name="date_to" id="date_to">
            </div>
            <div class="form-field">
               <label for="price">Cena:</label>
               <input type="text" name="price" id="price"> RSD
            </div>
            <div class="form-field">
               <input type="submit" name="submit" value="Dodaj destinaciju" />
            </div>
         </form>
      </section>
      <?php include('../includes/footer.php') ?>
   </body>
   </html>
   <?php
}
?>
