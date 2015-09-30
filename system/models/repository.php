<?php

/**
 * Repository model
 */
class Repository
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

}
?>
