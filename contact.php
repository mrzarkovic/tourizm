<?php
  include_once('includes/helpers.php');

  $msg_to_user = "";

  if ((!empty($_POST))&&(isset($_POST['submit'])))
  {
      $name = $_POST['name'];
      $message = $_POST['message'];
      $email = $_POST['email'];

      if (($message != "")&&($email != ""))
      {
         $message = wordwrap($message, 70, "\r\n");

         // To send HTML mail, the Content-type header must be set
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

         // Additional headers
         $headers .= 'To: Kontakt <kontakt@tourizm.rs>' . "\r\n";
         $headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";

         $send_email = mail('kontakt@tourizm.rs', 'Poruka sa sajta', $message, $headers);

         if ($send_email)
         {
            $msg_to_user = "Poruka je poslata! Hvala.";
         }
         else
         {
            $msg_to_user = "Došlo je do greške pri slanju poruke.";
         }
      }
      else
      {
         $msg_to_user = "Molimo napišete poruku i Vašu email adresu. Hvala.";
      }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Kontakt</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section class="main content">
      <h1>Kontakt</h1>
      <p class="notice"><?php echo $msg_to_user; ?></p>
      <form action="contact.php" method="post">
         <div class="form-field">
            <label for="name">Vaše ime:</label>
            <input type="text" name="name" id="name"/>
         </div>
         <div class="form-field">
            <label for="email">Vaš email:</label>
            <input type="email" name="email" id="email" placeholder="npr. vase.ime@primer.rs"/>
         </div>
         <div class="form-field">
            <label for="message">Vaša poruka:</label>
            <textarea name="message" id="message"></textarea>
         </div>
         <div class="form-field">
            <input type="submit" name="submit" value="Pošalji poruku" />
         </div>
      </form>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
