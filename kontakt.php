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
      <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d181139.85102770833!2d20.42032235!3d44.81524535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2srs!4v1443014457554" width="450" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
      <h1>Kontakt</h1>
      <p>Adresa: Danijelova 32<br>
         Telefon: 011/123-4-567<br>
         Email: kontakt@tourizm.app</p>
      <p class="notice"><?php echo $msg_to_user; ?></p>
      <form action="kontakt.php" method="post">
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
