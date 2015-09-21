<?php
session_start();

function connect_to_db()
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

  return $conn;
}

function user_logged_in()
{
  if (isset($_SESSION['username']))
  {
      return $_SESSION['username'];
  }

  return false;
}

/* DESTINATIONS */

function get_destinations()
{
  $conn = connect_to_db();

  $sql = "SELECT * FROM destinations";

  $result = $conn->query($sql);

  $destinations = array();

  if ($result->num_rows > 0)
  {
    while($destination = $result->fetch_object())
    {
      $destinations[] = $destination;
    }
    return $destinations;
  }
  else
  {
    return false;
  }
}

function get_destination($id = 0)
{
  $destination = "";

  $conn = connect_to_db();

  $sql = "SELECT * FROM destinations WHERE id='$id'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    $destination = $result->fetch_object();
    return $destination;
  }
  else
  {
    return false;
  }
}

/* end of DESTINATIONS */

/* RESERVATIONS */

function get_reservations()
{
  $conn = connect_to_db();

  $sql = "SELECT * FROM reservations";

  $result = $conn->query($sql);

  $reservations = array();

  if ($result->num_rows > 0)
  {
    while($destination = $result->fetch_object())
    {
      $reservations[] = $destination;
    }
    return $reservations;
  }
  else
  {
    return false;
  }
}

/* end of RESERVATIONS */

?>
