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

function find_destinations($keyword = "")
{
   $conn = connect_to_db();
   $sql = "SELECT * FROM destinations WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY id DESC";
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

function get_destinations($limit = 0, $start = 0)
{
  $conn = connect_to_db();

  if ( $limit != 0 )
  {
     $sql = "SELECT * FROM destinations ORDER BY id DESC LIMIT $start, $limit";
  }
  else
  {
     $sql = "SELECT * FROM destinations ORDER BY id DESC";
  }

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

function get_pretty_date($date = "0000-00-00")
{
   $pretty_date = new DateTime($date);
   return $pretty_date = $pretty_date->format('m.d.Y.');
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

/**
 * Get excerpt from string
 *
 * @param String $str String to get an excerpt from
 * @param Integer $startPos Position int string to start excerpt from
 * @param Integer $maxLength Maximum length the excerpt may be
 * @return String excerpt
 */
function getExcerpt($str, $startPos=0, $maxLength=100) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}

	return $excerpt;
}


?>
