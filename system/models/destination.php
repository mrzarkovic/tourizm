<?php

namespace Tourizm\Model;

use \DateTime;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destination extends Repository
{

   public $list;
   public $total;

   public function __construct( $row = array() )
   {
      parent::__construct();

      $this->list			= array();
		$this->total		= 0;

      $this->id = (int) ( isset($row['id']) ? $row['id'] : 0 );
      $this->name = ( isset($row['name']) ? $row['name'] : "" );
      $this->description = ( isset($row['description']) ? $row['description'] : "" );
      $this->price = (int) ( isset($row['price']) ? $row['price'] : 0 );
      $this->date_from = isset($row['date_from']) ? new DateTime($row['date_from']) : new DateTime();
      $this->date_to = isset($row['date_to']) ? new DateTime($row['date_to']) : new DateTime();
      $this->image_path = ( isset($row['image_path']) ? $row['image_path'] : "" );
      $this->total_quota = (int) ( isset($row['total_quota']) ? $row['total_quota'] : 0 );
   }

   /**
    * Search the database for a destination with a keyword
    * @param  string $keyword Search parameter
    * @return bool
    */
   function find_destinations( $keyword = "" )
   {
      // Empty the list array
      $this->list = array();

      $sql = "SELECT * FROM destinations WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY id DESC";
      $result = $this->connection->query( $sql );

      if ( $result->num_rows > 0 )
      {
        while( $destination = $result->fetch_assoc() )
        {
          $this->list[] = new self( $destination );
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
    * Get all the destinations from the database
    * @param  integer $limit How many
    * @param  integer $start Start from position
    * @return bool
    */
   function get_destinations( $limit = 0, $start = 0 )
   {
     if ( $limit != 0 )
     {
        $sql = "SELECT * FROM destinations ORDER BY id DESC LIMIT $start, $limit";
     }
     else
     {
        $sql = "SELECT * FROM destinations ORDER BY id DESC";
     }

     $result = $this->connection->query( $sql );

     $destinations = array();

     if ( $result->num_rows > 0 )
     {
       while( $destination = $result->fetch_assoc() )
       {
          $this->list[] = new self($destination);
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
    * Return a single destination
    * @param  integer $id Destination id
    * @return bool
    */
   function get_destination( $id = 0 )
   {
     $sql = "SELECT * FROM destinations WHERE id='$id'";

     $result = $this->connection->query( $sql );

     if ( $result->num_rows > 0 )
     {
       $destination = $result->fetch_assoc();
       $this->__construct( $destination );
       return true;
     }
     else
     {
       return false;
     }
   }

   /**
    * Add a new destination to the database
    * @param $image_path Path to the featured image
    */
   public function add_destination_to_db( $image_path )
   {
      // Prevent SQL Injection
      $this->name = $this->connection->real_escape_string( $_POST['name'] );
      $this->description = $this->connection->real_escape_string( $_POST['description'] );
      $this->total_quota = $this->connection->real_escape_string( $_POST['total_quota'] );
      $this->price = $this->connection->real_escape_string( $_POST['price'] );

      $this->date_from = new DateTime( $_POST['date_from'] );
      $this->date_to = new DateTime( $_POST['date_to'] );

      $date_from = $this->date_from->format('Y-m-d H:i:s');
      $date_to = $this->date_to->format('Y-m-d H:i:s');

      $this->image_path = $image_path;

      $sql = "INSERT INTO destinations (name, description, total_quota, image_path, date_from, date_to, price) VALUES ('$this->name', '$this->description', '$this->total_quota', '$this->image_path', '$date_from', '$date_to', '$this->price')";

      $result = $this->connection->query($sql);

      if ($error = $this->connection->error)
      {
         return false;
      }

      return true;
   }

   public function update_destination_in_db( $image_path )
   {
      // Prevent SQL Injection
      $this->name = $this->connection->real_escape_string( $_POST['name'] );
      $this->description = $this->connection->real_escape_string( $_POST['description'] );
      $this->total_quota = $this->connection->real_escape_string( $_POST['total_quota'] );
      $this->price = $this->connection->real_escape_string( $_POST['price'] );

      $this->date_from = new DateTime( $_POST['date_from'] );
      $this->date_to = new DateTime( $_POST['date_to'] );

      $date_from = $this->date_from->format('Y-m-d H:i:s');
      $date_to = $this->date_to->format('Y-m-d H:i:s');

      $this->image_path = $image_path;

      $sql = "UPDATE destinations SET name = '$this->name', description = '$this->description', total_quota = '$this->total_quota', image_path = '$this->image_path', date_from = '$date_from', date_to = '$date_to', price = '$this->price' WHERE id = '$this->id'";

     $result = $this->connection->query( $sql );

     if ( $error = $this->connection->error )
     {
       return false;
     }

      return true;
   }

   /**
    * Delete the destination from the database
    * @param  int $id Destination id
    * @return bool
    */
   function delete_destination( $id = 0 )
   {

      $id = $this->connection->real_escape_string( $id );
      $sql = "DELETE FROM destinations WHERE id = '$id'";
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

   /**
    * Return total number of reservations left
    * for a destination
    * @return int total Number of reservations left
    */
   function get_reservatons_left()
   {
      $total_quota = $this->total_quota;
      $reservation = new Reservation();
      $reservation->get_reservations_for_destination( $this->id );
      $total_reservations = $reservation->total;

      return (int) $total_quota - (int) $total_reservations;
   }
}
