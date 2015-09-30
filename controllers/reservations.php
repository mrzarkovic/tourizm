<?php

/**
 * Reservations controller
 */
class Reservations extends Core
{
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

      include('views/reservation.php');
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

         include('/views/admin/manage-reservations.php');
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
         include('/views/admin/delete-reservation.php');
      }
   }
}
