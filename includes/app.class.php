<?php

/**
 * Main application class
 */
class App
{
   /**
   * Stores a message for the user
   * @var object
   */
   public $msg_to_user;

   function __construct()
   {
      session_start();
   }

   /**
    * Connect to a database
    * @return mysqli connection
    */
   function connect_to_db()
   {
     // Database connection
     $db_user = "root";
     $db_pass = "";
     $hostname = "localhost";
     $db_name   = "tourizm";

     $conn = new mysqli( $hostname, $db_user, $db_pass, $db_name );

     if ( $conn->connect_error ) {
         die( "Connection failed: " . $conn->connect_error );
     }

     return $conn;
   }

   /**
    * Check to see if user is logged in
    * @return string Username
    */
   function user_logged_in()
   {
     if ( isset( $_SESSION['username'] ) )
     {
         return $_SESSION['username'];
     }

     return false;
   }

   /**
    * Log in user to the system
    * Add username to $_SESSION['username']
    * @return HTTP redirect
    */
   function login_user()
   {
      // Check input
      if ( ( $_POST['username'] == '' ) || ( $_POST['password'] == '' ) )
      {
        $this->msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
         // Database connection
         $conn = $this->connect_to_db();

         // Prevent SQL Injection
         $username = $conn->real_escape_string($_POST['username']);
         $password = $conn->real_escape_string($_POST['password']);

         // Encrypt the pasword
         $password = md5( $password );

         // Check credentials
         $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

         $result = $conn->query( $sql );

         if ( $result->num_rows > 0 )
         {
           $_SESSION['username'] = $username;
           header('Location: admin/manage-destinations.php');
         }
         else
         {
           $this->msg_to_user = "Pogrešan username ili password.";
         }

         $conn->close();
      }
   }

   /**
    * Log out user from the system
    * @return HTTP redirect
    */
   function logout_user()
   {
      // Check if user is logged in
      if ( $user = $this->user_logged_in() )
      {
        // Remove all session variables
        session_unset();
      }
      header('Location: /tourizm/login.php');
   }

   /* DESTINATIONS */

   /**
    * Return total number of reservations left
    * for a destination
    * @param  Object $destination Destination object
    * @return int total Number of reservations left
    */
   function get_reservatons_left( $destination )
   {
      $total_quota = $destination->total_quota;
      $reservations = $this->get_reservations_for_destination( $destination->id );
      $total_reservations = count( $reservations );

      return (int) $total_quota - (int) $total_reservations;
   }

   /**
    * Search the database for a destination with a keyword
    * @param  string $keyword Search parameter
    * @return array $destinations Array of Objects
    */
   function find_destinations( $keyword = "" )
   {
      $conn = $this->connect_to_db();
      $sql = "SELECT * FROM destinations WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY id DESC";
      $result = $conn->query( $sql );

      $destinations = array();

      if ( $result->num_rows > 0 )
      {
        while( $destination = $result->fetch_object() )
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

   /**
    * Get all the destinations from the database
    * @param  integer $limit How many
    * @param  integer $start Start from position
    * @return array destinations Array of Objects
    */
   function get_destinations( $limit = 0, $start = 0 )
   {
     $conn = $this->connect_to_db();

     if ( $limit != 0 )
     {
        $sql = "SELECT * FROM destinations ORDER BY id DESC LIMIT $start, $limit";
     }
     else
     {
        $sql = "SELECT * FROM destinations ORDER BY id DESC";
     }

     $result = $conn->query( $sql );

     $destinations = array();

     if ( $result->num_rows > 0 )
     {
       while( $destination = $result->fetch_object() )
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

   /**
    * Return a single destination
    * @param  integer $id Destination id
    * @return Objct destination
    */
   function get_destination( $id = 0 )
   {
     $destination = "";

     $conn = $this->connect_to_db();

     $sql = "SELECT * FROM destinations WHERE id='$id'";

     $result = $conn->query( $sql );

     if ( $result->num_rows > 0 )
     {
       $destination = $result->fetch_object();
       return $destination;
     }
     else
     {
       return false;
     }
   }

   /**
    * Add a new destination to the database
    */
   function add_destination()
   {
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
         $this->msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
         $conn = $this->connect_to_db();

         // Prevent SQL Injection
         $name = $conn->real_escape_string( $_POST['name'] );
         $description = $conn->real_escape_string( $_POST['description'] );
         $total_quota = $conn->real_escape_string( $_POST['total_quota'] );
         $price = $conn->real_escape_string( $_POST['price'] );

         $date_from = new DateTime( $_POST['date_from'] );
         $date_to = new DateTime( $_POST['date_to'] );

         $date_from = $date_from->format('Y-m-d H:i:s');
         $date_to = $date_to->format('Y-m-d H:i:s');

         $target_dir = "../img/destinations/";
         $target_file = $target_dir . basename( $_FILES["image"]["name"] );
         $upload_ok = 1;
         $imageFileType = pathinfo( $target_file, PATHINFO_EXTENSION );

         $image_path = basename( $_FILES["image"]["name"] );

         // Check if file is image
         $check = getimagesize( $_FILES["image"]["tmp_name"] );
         if( $check !== false )
         {
            if ( move_uploaded_file( $_FILES["image"]["tmp_name"], $target_file ) )
            {
               $sql = "INSERT INTO destinations (name, description, total_quota, image_path, date_from, date_to, price) VALUES ('$name', '$description', '$total_quota', '$image_path', '$date_from', '$date_to', '$price')";

               $result = $conn->query($sql);

               if ($error = $conn->error)
               {
                  $this->msg_to_user = "Došlo je do greske pri čuvanju. " . $error;
               }
               else
               {
                  $this->msg_to_user = "Uspešno ste dodali destinaciju: " . $name;
               }
            }
            else
            {
               $this->msg_to_user = "Greska prilikom uploadovanja";
            }
         }
         else
         {
            $this->msg_to_user = "Pogresan fajl.";
         }
         $conn->close();
      }
   }

   /**
    * Edit a destination
    * @param $id Destination id
    */
   function edit_destination( $id = 0 )
   {
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
        $this->msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
        $conn = $this->connect_to_db();

        $image_path = $_POST['image_path'];

        // Prevent SQL Injection
        $name = $conn->real_escape_string( $_POST['name'] );
        $description = $conn->real_escape_string( $_POST['description'] );
        $total_quota = $conn->real_escape_string( $_POST['total_quota'] );
        $price = $conn->real_escape_string( $_POST['price'] );

        $date_from = new DateTime( $_POST['date_from'] );
        $date_to = new DateTime( $_POST['date_to'] );

        $date_from = $date_from->format('Y-m-d H:i:s');
        $date_to = $date_to->format('Y-m-d H:i:s');

        if ($_FILES["image"]["name"])
        {
           $target_dir = "../img/destinations/";
          $target_file = $target_dir . basename( $_FILES["image"]["name"] );
          $upload_ok = 1;
          $imageFileType = pathinfo( $target_file, PATHINFO_EXTENSION );

          $image_path = basename( $_FILES["image"]["name"] );

          // Check if file is image
          $check = getimagesize( $_FILES["image"]["tmp_name"] );
          if( $check !== false )
          {
            if ( !move_uploaded_file( $_FILES["image"]["tmp_name"], $target_file ) )
            {
              $this->msg_to_user = "Greska prilikom uploadovanja";
            }
          }
          else
          {
              $this->msg_to_user = "Pogresan fajl.";
          }
        }

        $sql = "UPDATE destinations SET name = '$name', description = '$description', total_quota = '$total_quota', image_path = '$image_path', date_from = '$date_from', date_to = '$date_to', price = '$price' WHERE id = '$id'";

       $result = $conn->query( $sql );

       if ( $error = $conn->error )
       {
         $this->msg_to_user = "Došlo je do greske pri čuvanju. " . $error;
       }
       else
       {
         $this->msg_to_user = "Uspešno ste izmenili destinaciju: " . $name;
       }
        $conn->close();
      }

   }

   /**
    * Delete the destination from the database
    * @param  int $id Destination id
    * @return string     Message to user
    */
   function delete_destination( $id = 0 )
   {
      $conn = $this->connect_to_db();
      $id = $conn->real_escape_string( $id );
      $sql = "DELETE FROM destinations WHERE id = '$id'";
      $conn->query( $sql );

      if ( $error = $conn->error )
      {
        $this->msg_to_user = "Došlo je do greske pri brisanju. " . $error;
      }
      else
      {
        $this->msg_to_user = "Uspešno ste obrisali destinaciju.";
      }

      $conn->close();
   }

   /**
    * Format the date from database to display on page
    * @param  string $date
    * @return string pretty_date
    */
   function get_pretty_date( $date = "0000-00-00" )
   {
      $pretty_date = new DateTime( $date );
      return $pretty_date = $pretty_date->format('m.d.Y.');
   }

   /* end of DESTINATIONS */

   /* RESERVATIONS */

   /**
    * Add a reservation to the database
    * @param  integer $destination_id
    */
   function make_reservation( $destination_id = 0 )
   {
      // Check destination
      $destination = $this->get_destination( $destination_id );
      if ( $destination )
      {
         $reservations_left = $this->get_reservatons_left( $destination );
         if ( $reservations_left > 0 )
         {
            // Check input
            if ( ( $_POST['customer_name'] == '' ) || ( $_POST['customer_email'] == '' ) || ( $_POST['customer_phone'] == '' ) )
            {
              $this->msg_to_user = "Morate popuniti sva polja.";
            }
            else
            {
              $conn = $this->connect_to_db();

              // Prevent SQL Injection
              $customer_name = $conn->real_escape_string( $_POST['customer_name'] );
              $customer_email = $conn->real_escape_string( $_POST['customer_email'] );
              $customer_phone = $conn->real_escape_string( $_POST['customer_phone'] );

              $sql = "INSERT INTO reservations (destination_id, customer_name, customer_email, customer_phone) VALUES ('$destination_id', '$customer_name', '$customer_email', '$customer_phone')";

              $result = $conn->query( $sql );

              if ( $error = $conn->error )
              {
                $this->msg_to_user = "Došlo je do greske pri čuvanju rezervacije. " . $error;
              }
              else
              {
                $this->msg_to_user = "Uspešno ste rezervisali destinaciju: " . $destination->name;
              }

              $conn->close();
            }
         }
         else
         {
            $this->msg_to_user = "Nema više slobodnih mesta za ovu destinaciju.";
         }
      }
      else
      {
         $this->msg_to_user = "Destinacija ne postoji.";
      }
   }

   /**
    * Get all the reservations
    * @return array reservations Array of Objects
    */
   function get_reservations()
   {
     $conn = $this->connect_to_db();

     $sql = "SELECT * FROM reservations";

     $result = $conn->query( $sql );

     $reservations = array();

     if ( $result->num_rows > 0 )
     {
       while( $destination = $result->fetch_object() )
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

   /**
    * Delete a reservation from the database
    * @param $id Reservation id
    */
   function delete_reservation( $id = 0 )
   {
      $conn = $this->connect_to_db();
      $id = $conn->real_escape_string( $id );
      $sql = "DELETE FROM reservations WHERE id = '$id'";
      $conn->query( $sql );

      if ( $error = $conn->error )
      {
        $this->msg_to_user = "Došlo je do greske pri brisanju. " . $error;
      }
      else
      {
        $this->msg_to_user = "Uspešno ste obrisali rezervaciju.";
      }

      $conn->close();
   }

   /**
    * Get all the reservations for a destination
    * @param  int $destination_id
    * @return array reservations Array of Objects
    */
   function get_reservations_for_destination( $destination_id )
   {
     $conn = $this->connect_to_db();

     $sql = "SELECT * FROM reservations WHERE destination_id = '$destination_id'";

     $result = $conn->query( $sql );

     $reservations = array();

     if ( $result->num_rows > 0 )
     {
       while ( $destination = $result->fetch_object() )
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
    * @param string $str String to get an excerpt from
    * @param int $startPos Position int string to start excerpt from
    * @param int $maxLength Maximum length the excerpt may be
    * @return string excerpt
    */
   function get_excerpt( $str, $startPos=0, $maxLength=100 ) {
   	if( strlen( $str ) > $maxLength ) {
   		$excerpt   = substr( $str, $startPos, $maxLength-3 );
   		$lastSpace = strrpos( $excerpt, ' ' );
   		$excerpt   = substr( $excerpt, 0, $lastSpace );
   		$excerpt  .= '...';
   	} else {
   		$excerpt = $str;
   	}

   	return $excerpt;
   }

   /**
    * Send an email message from the contact form
    */
   function send_contact_message()
   {
      $name = $_POST['name'];
      $message = $_POST['message'];
      $email = $_POST['email'];

      if ( ( $message != "" ) && ( $email != "" ) )
      {
         $message = wordwrap( $message, 70, "\r\n" );

         // To send HTML mail, the Content-type header must be set
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

         // Additional headers
         $headers .= 'To: Kontakt <kontakt@tourizm.rs>' . "\r\n";
         $headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";

         $send_email = mail( 'kontakt@tourizm.rs', 'Poruka sa sajta', $message, $headers );

         if ( $send_email )
         {
            $this->msg_to_user = "Poruka je poslata! Hvala.";
         }
         else
         {
            $this->msg_to_user = "Došlo je do greške pri slanju poruke.";
         }
      }
      else
      {
         $this->msg_to_user = "Molimo napišite poruku i Vašu email adresu. Hvala.";
      }

   }

}
?>
