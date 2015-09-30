<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logger extends Core
{
   public function login()
   {
      if ( !empty( $_POST ) )
      {
         $this->_login_user();
      }
      include(BASEPATH .' /views/login.php');
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
         $user = new User();
         if ( $user->login_user( $_POST['username'], $_POST['password'] ) )
         {
            header('Location: /admin/manage-destinations');
         }
         else
         {
           $this->msg_to_user = "Pogrešan username ili password.";
           return false;
         }
      }
   }

   public function logout()
   {
      $user = new User();
      $user->logout_user();
   }
}
