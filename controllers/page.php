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

}
