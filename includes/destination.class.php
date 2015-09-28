<?php

class Destination extends App
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
      $sql = "SELECT * FROM destinations WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY id DESC";
      $result = $this->connection->query( $sql );

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
         // Prevent SQL Injection
         $name = $this->connection->real_escape_string( $_POST['name'] );
         $description = $this->connection->real_escape_string( $_POST['description'] );
         $total_quota = $this->connection->real_escape_string( $_POST['total_quota'] );
         $price = $this->connection->real_escape_string( $_POST['price'] );

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

               $result = $this->connection->query($sql);

               if ($error = $this->connection->error)
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
         $this->connection->close();
      }
   }
}

?>
