<?php
session_start();
include('includes/app.class.php');
$app = new App();

if ( !empty( $_POST ) )
{
   $app->login_user();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tourizm | Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section class="main content">
      <h1>Prijava na sistem</h1>
      <p class="notice">
        <?php echo $app->msg_to_user; ?>
      </p>
      <form action="login.php" method="post">
        <div class="form-field">
          <label for="username">Korisničko ime</label>
          <input type="text" name="username" id="username" />
        </div>
        <div class="form-field">
          <label for="password">Lozinka</label>
          <input type="password" name="password" id="password" />
        </div>
        <div class="form-field">
          <input type="submit" name="submit" value="Prijavi se" />
        </div>
      </form>
    </section>
    <?php include('includes/footer.php') ?>
  </body>
</html>
