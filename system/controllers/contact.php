<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contact controller
 */
class Contact extends Core
{
   public function index()
   {
      if ( ( !empty( $_POST ) ) && ( isset( $_POST['submit'] ) ) )
      {
         $this->_send_contact_message();
      }
      include(BASEPATH .' /views/contact.php');
   }

   /**
    * Send an email message from the contact form
    */
   private function _send_contact_message()
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
