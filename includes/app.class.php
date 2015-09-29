<?php

/**
 * Main application class
 */
class App
{

   public $connection;

   function __construct()
   {
      $this->connection = $this->connect_to_db();
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
      // Prevent SQL Injection
      $username = $this->connection->real_escape_string($_POST['username']);
      $password = $this->connection->real_escape_string($_POST['password']);

      // Encrypt the pasword
      $password = md5( $password );

      // Check credentials
      $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

      $result = $this->connection->query( $sql );

      if ( $result->num_rows > 0 )
      {
        $_SESSION['username'] = $username;
        return true;
      }
      return false;
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
