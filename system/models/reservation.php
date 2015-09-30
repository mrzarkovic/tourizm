<?php

class Reservation extends Repository
{

   public $list;
   public $total;

   public function __construct( $row = array() )
   {
      parent::__construct();

      $this->list			= array();
		$this->total		= 0;

      $this->id               = (int) ( isset($row['id']) ? $row['id'] : 0 );
      $this->destination_id   = (int) ( isset($row['destination_id']) ? $row['destination_id'] : 0 );
      $this->customer_name    = ( isset($row['customer_name']) ? $row['customer_name'] : "" );
      $this->customer_phone   = ( isset($row['customer_phone']) ? $row['customer_phone'] : "" );
      $this->customer_email   = ( isset($row['customer_email']) ? $row['customer_email'] : "" );
   }

   /**
    * Get all the reservations for a destination
    * @param  int $destination_id
    * @return array reservations Array of Objects
    */
   function get_reservations_for_destination( $destination_id )
   {
     $sql = "SELECT * FROM reservations WHERE destination_id = '$destination_id'";

     $result = $this->connection->query( $sql );

     $reservations = array();

     if ( $result->num_rows > 0 )
     {
       while ( $reservation = $result->fetch_assoc() )
       {
         $this->list[] = new self( $reservation );
         $this->total++;
       }
       return true;
     }
     else
     {
       return false;
     }
   }

   /**
    * Add a reservation to the database
    * @param  integer $destination_id
    */
   function add_reservation_to_db()
   {
      // Prevent SQL Injection
      $this->customer_name = $this->connection->real_escape_string( $_POST['customer_name'] );
      $this->customer_email = $this->connection->real_escape_string( $_POST['customer_email'] );
      $this->customer_phone = $this->connection->real_escape_string( $_POST['customer_phone'] );

      $sql = "INSERT INTO reservations (destination_id, customer_name, customer_email, customer_phone) VALUES ('$this->destination_id', '$this->customer_name', '$this->customer_email', '$this->customer_phone')";

      $result = $this->connection->query( $sql );

      if ( $error = $this->connection->error )
      {
       return false;
      }
      else
      {
       return true;
      }
   }

   /**
    * Get all the reservations
    * @return array reservations Array of Objects
    */
   function get_reservations()
   {
     $sql = "SELECT * FROM reservations";

     $result = $this->connection->query( $sql );

     if ( $result->num_rows > 0 )
     {
       while( $reservation = $result->fetch_assoc() )
       {
          $this->list[] = new self( $reservation );
          $this->total++;
       }
       return true;
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
      $id = $this->connection->real_escape_string( $id );
      $sql = "DELETE FROM reservations WHERE id = '$id'";
      $this->connection->query( $sql );
      if ( $error = $this->connection->error )
      {
         return false;
      }
      else
      {
         return true;
      }

   }

}
