<?php

include('includes/helpers.php');

$msg_to_user = "";

if (!empty($_POST))
{
  // Check input
  if ( ($_POST['username'] == '') || ($_POST['password'] == ''))
  {
    $msg_to_user = "Morate popuniti sva polja.";
  }
  else
  {
    // Database connection
    $db_user = "root";
    $db_pass = "";
    $hostname = "localhost";
    $db_name   = "tourizm";

    $conn = new mysqli($hostname, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prevent SQL Injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Encrypt the pasword
    $password = md5($password);

    // Check credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      $_SESSION['username'] = $username;
      header('Location: admin/manage-destinations.php');
    }
    else
    {
      $msg_to_user = "Pogrešan username ili password.";
    }

    $conn->close();
  }
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
        <?php echo $msg_to_user; ?>
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
