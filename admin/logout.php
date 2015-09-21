<?php

include('../includes/helpers.php');

if ( $user = user_logged_in() )
{
  // remove all session variables
  session_unset();
}
header('Location: /tourizm/login.php');
?>
