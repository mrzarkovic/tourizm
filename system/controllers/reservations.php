<?php

namespace Tourizm\Controller;

use \Tourizm\Model\Reservation;
use \Tourizm\Model\Destination;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Reservations controller
 */
class Reservations extends Core
{
   public function __construct()
   {
      parent::__construct();
      $this->title = "Rezervacije";
   }

   public function index( $destination_id = 0 )
   {

      if (!empty( $_POST ) && isset( $_POST['destination_id'] ) )
      {
        $destination_id = $_POST['destination_id'];
        if ( $this->_make_reservation( $destination_id ) )
        {
            $reservation = new Reservation();
            $reservation->destination_id = (int) $destination_id;

            if ( $reservation->add_reservation_to_db() )
            {
               $this->msg_to_user = "Uspešno ste rezervisali destinaciju.";
            }
            else
            {
               $this->msg_to_user = "Došlo je do greske pri čuvanju rezervacije. ";
            }
         }
      }

      $destination = new Destination();
      $destination->get_destination( $destination_id );

      $this->to_tpl['destination'] = $destination;
      $this->template = "reservation";
   }

   private function _make_reservation( $destination_id = 0 )
   {
      // Check destination
      $destination = new Destination();
      $destination->get_destination( $destination_id );

      if ( $destination )
      {
         $reservations_left = $destination->get_reservatons_left();
         if ( $reservations_left > 0 )
         {
            // Check input
            if ( ( $_POST['customer_name'] == '' ) || ( $_POST['customer_email'] == '' ) || ( $_POST['customer_phone'] == '' ) )
            {
              $this->msg_to_user = "Morate popuniti sva polja.";
              return false;
            }
         }
         else
         {
            $this->msg_to_user = "Nema više slobodnih mesta za ovu destinaciju.";
            return false;
         }
      }
      else
      {
         $this->msg_to_user = "Destinacija ne postoji.";
         return false;
      }
      return true;
   }

}
