<?php

namespace Tourizm\Controller;

use \Tourizm\Model\Destination;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin destinations controller
 */
class Admin_destinations extends Core
{
   public function __construct()
   {
      parent::__construct();
      $this->page_name = "Admin - Destinacije";
   }
   /**
    * Show the page for managing the destinations
    */
   public function manage()
   {
      if ( !user_logged_in() )
      {
         header('Location: /login');
      }
      $destinations = new Destination();
      $destinations->get_destinations();

      $this->page_name = "Pregled destinacija";
      $this->to_tpl['destinations'] = $destinations;
      $this->template = "admin/manage-destinations";
   }

   /**
    * Show the page for editing a destination
    * @param integer $id Destination id
    */
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

         $this->page_name = "Izmena destinacije: " . $destination->name;
         $this->to_tpl['destination'] = $destination;
         $this->template = "/admin/edit-destination";
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
               // Delete the previous image
               $this->_delete_image($destination->image_path);
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

   /**
   * Show a delete page
   * @param  integer $id Destination id
   */
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
            $destination->get_destination($id);
            $image_path = $destination->image_path;
            if ( $destination->delete_destination( $id ) )
            {
               if ( $this->_delete_image($image_path) )
                  $this->msg_to_user = "Uspešno ste obrisali destinaciju.";
               else
                  $this->msg_to_user = "Greška prilikom brisanja slike.";
            }
            else
            {
               $this->msg_to_user = "Došlo je do greske prilikom brisanja.";
            }
        }

        $this->page_name = "Brisanje destinacije: " . $destination->name;
        $this->template = "/admin/delete-destination";
      }
   }

   /**
   * Show an empty form for adding new Destinations
   */
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
         }

         $this->page_name = "Dodavanje nove destinacije";
         $this->template = "/admin/add-destination";
      }
   }

   /**
    * Check POST data before adding to the database
    */
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

   /**
    * Upload a new image to the server
    * @return string $filename File name
    */
   private function _upload_image()
   {
      $target_dir = "img/destinations/";
      $extension = pathinfo( basename($_FILES["image"]["name"]), PATHINFO_EXTENSION );
      $filename = microtime() . "." . $extension;
      $target_file = $target_dir . $filename;

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

      return $filename;
   }


   /**
   * Unlink an image from the destinations images directory
   * @param  string $name File name
   * @return bool
   */
   private function _delete_image( $name )
   {
      // Don't delete the default image
      if ( $name == "default.jpg" )
         return true;

      if ( unlink( '../public/img/destinations/' . $name ) )
         return true;

      return false;
   }

}
