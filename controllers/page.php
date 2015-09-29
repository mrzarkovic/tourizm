<?php

/**
 * Page controller
 */
class Page extends Core
{
   public function home()
   {
      $destination = new Destination();
      $destination->get_destinations( $limit = 4 );

      include('views/home.php');
   }

   public function login()
   {
      if ( !empty( $_POST ) )
      {
         $this->_login_user();
      }
      include('views/login.php');
   }

   private function _login_user()
   {
      // Check input
      if ( ( $_POST['username'] == '' ) || ( $_POST['password'] == '' ) )
      {
        $this->msg_to_user = "Morate popuniti sva polja.";
      }
      else
      {
         $app = new App();
         if ($app->login_user())
         {
            header('Location: admin/manage-destinations.php');
         }
         else
         {
           $this->msg_to_user = "Pogrešan username ili password.";
           return false;
         }
      }
   }

}
