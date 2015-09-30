<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Destinations controller
 */
class Destinations extends Core
{
   /**
    * Show index page for destinations
    */
   public function listing( $page = 0 )
   {
      // Limit destinations per page
      $per_page = 4;

      if ( !empty( $page ) )
      {
         // Get the current page
         $page = (int) $page - 1;
      }
      else
      {
         $page = 0;
      }

      $start = $per_page * $page;
      $destination = new Destination();
      $destination->get_destinations( $per_page, $start );

      $all_destinations = new Destination();
      $all_destinations->get_destinations();

      $destinations_count = $all_destinations->total;
      $max_page = ceil( $destinations_count / $per_page );

      if ( !empty( $_POST['search'] ) )
      {
          $keyword = $_POST['search'];
          $destination->find_destinations( $keyword );
      }

      include(BASEPATH .' /views/destinations.php');
   }

   public function show( $id = 0 )
   {
      if (!empty($id) && isset($id))
      {
         $destination = new Destination();
         $destination->get_destination( $id );
      }
      include(BASEPATH .' /views/destination.php');
   }

   public function manage()
   {
      if ( !user_logged_in() )
      {
         header('Location: /login');
      }
      $destination = new Destination();
      $destination->get_destinations();

      include(BASEPATH .' /views/admin/manage-destinations.php');
   }

   public function edit( $id = 0 )
   {
      if ( !user_logged_in() )
      {
         header('Location: /login');
      }
      else
      {
         $destination = new Destination();
         if ( !empty( $id ) && isset( $id ) )
         {
            $destination->get_destination( $id );
         }

         if ( !empty( $_POST ) )
         {
            $id = $_POST['destination_id'];
            $destination->get_destination( $id );
            if ( $image_path = $this->_check_input_before_update( $id ) )
            {
               if ( $destination->update_destination_in_db( $image_path ) )
               {
                  $this->msg_to_user = "Uspešno ste izmenili destinaciju: " . $destination->name;
               }
               else
               {
                  $this->msg_to_user = "Došlo je do greske prilikom čuvanja.";
               }
            }
         }

         include(BASEPATH .' /views/admin/edit-destination.php');
      }
   }

   /**
    * Check the input data brefore updating an entry
    * @param $id Destination id
    * @return string $image_path
    */
   private function _check_input_before_update( $id )
   {
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
        $this->msg_to_user = "Morate popuniti sva polja.";
        return false;
      }
      else
      {
         if ( $_FILES["image"]["name"] )
         {
            if ( $image_path = $this->_upload_image() )
            {
               $destination = new Destination();
               $destination->get_destination( $id );
               // Delete the previous image if it's not the same
               if ( $_FILES["image"]["name"] != $destination->image_path )
                  unlink( '../public/img/destinations/' . $destination->image_path );
            }
            else
            {
               return false;
            }
         }
         else
         {
            $image_path = $_POST['image_path'];
         }
      }
      return $image_path;
   }



   public function delete( $id = 0 )
   {
      if ( !user_logged_in() )
      {
        header('Location: /login');
      }
      else
      {
        if ( $id )
        {
            $destination = new Destination();
            if ( $destination->delete_destination( $id ) )
            {
               $this->msg_to_user = "Uspešno ste obrisali destinaciju.";
            }
            else
            {
               $this->msg_to_user = "Došlo je do greske prilikom brisanja.";
            }
        }

        include(BASEPATH .' /views/admin/delete-destination.php');
      }
   }

   public function add()
   {
      if ( !user_logged_in() )
      {
         header('Location: /login');
      }
      else
      {
         if ( !empty( $_POST ) )
         {
            $destination = new Destination();
            if ( $image_path = $this->_check_input_before_add() )
            {
               if ( $destination->add_destination_to_db( $image_path ) )
               {
                  $this->msg_to_user = "Uspešno ste dodali novu destinaciju.";
               }
               else
               {
                  $this->msg_to_user = "Došlo je do greske pri čuvanju.";
               }
            }
            else
            {
               $this->msg_to_user = "Error.";
            }
         }

         include(BASEPATH .' /views/admin/add-destination.php');
      }
   }

   private function _check_input_before_add()
   {
      // Check input
      if ( ($_POST['name'] == '') || ($_POST['description'] == '') || ($_POST['total_quota'] == ''))
      {
         $this->msg_to_user = "Morate popuniti sva polja.";
         return false;
      }
      else
      {
         if (!empty($_FILES["image"]["name"]))
         {
            $image_path = $this->_upload_image();
         }
         else
         {
            $image_path = "default.jpg";
         }
         return $image_path;
      }
   }

   private function _upload_image()
   {
      $target_dir = "img/destinations/";
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
           return false;
         }
      }
      else
      {
        $this->msg_to_user = "Pogresan fajl.";
        return false;
      }

      return $image_path;
   }
}
