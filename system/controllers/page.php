<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Page controller
 */
class Page extends Core
{
   public function home()
   {
      $destination = new Destination();
      $destination->get_destinations( $limit = 4 );

      include(BASEPATH .' /views/home.php');
   }

}
