<?php

namespace Tourizm\Controller;

use \Tourizm\Model\Reservation;
use \Tourizm\Model\Destination;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin_reservations controller
 */
class Admin_reservations extends Core
{
   public function __construct()
   {
      parent::__construct();
      $this->page_name = "Admin - Rezervacije";
   }
   public function manage()
   {
      if ( !user_logged_in() )
      {
         header('Location: /login.php');
      }
      else
      {
         $destination = new Destination();
         $reservation = new Reservation();
         $reservation->get_reservations();

         $this->to_tpl['reservation'] = $reservation;
         $this->to_tpl['destination'] = $destination;
         $this->page_name = "Pregled rezervacija";
         $this->template = "admin/manage-reservations";
      }
   }

   public function delete( $id = 0 )
   {

      if ( !user_logged_in() )
      {
         header('Location: /login.php');
      }
      else
      {
         if ( $id != 0 )
         {
            $reservation = new Reservation();
            if ( $reservation->delete_reservation( $id ) )
            {
               $this->msg_to_user = "Uspešno ste obrisali rezervaciju.";
            }
            else
            {
               $this->msg_to_user = "Došlo je do greske prilikom brisanja.";
            }
         }
         else
         {
            $this->msg_to_user = "Rezervacija ne postoji.";
         }

         $this->page_name = "Brisanje rezervacije";
         $this->template = "admin/delete-reservation";
      }
   }

}
