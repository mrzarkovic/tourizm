<?php

namespace Tourizm\Controller;

use \Tourizm\Model\Destination;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Destinations controller
 */
class Destinations extends Core
{
   public function __construct()
   {
      parent::__construct();
      $this->page_name = "Destinacije";
   }
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
      $destinations = new Destination();
      $destinations->get_destinations( $per_page, $start );

      $all_destinations = new Destination();
      $all_destinations->get_destinations();

      $destinations_count = $all_destinations->total;
      $max_page = ceil( $destinations_count / $per_page );

      if ( !empty( $_POST['search'] ) )
      {
          $keyword = $_POST['search'];
          $destinations->find_destinations( $keyword );
      }

      $this->to_tpl['max_page'] = $max_page;
      $this->to_tpl['page'] = $page;
      $this->to_tpl['destinations'] = $destinations;
      $this->template = "destinations";
      $this->page_name = "Lista destinacija";

   }

   /**
    * Show a page for a single destination
    * @param  integer $id Destination id
    */
   public function show( $id = 0 )
   {
      if (!empty($id) && isset($id))
      {
         $destination = new Destination();
         $destination->get_destination( $id );
      }

      $this->to_tpl['destination'] = $destination;
      $this->page_name = $destination->name;
      $this->template = "destination";
   }
}
