<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Core controller
 */
class Core
{
   /**
   * Stores a message for the user
   * @var string
   */
   public $msg_to_user;

   /**
    * Stores template data
    * @var array
    */
   public $to_tpl;

   public function __construct()
   {
      $this->to_tpl = array();
      $this->msg_to_user = "";
   }

   public function load_template( $filename = "" )
   {
      foreach ( $this->to_tpl as $variable => $value )
      {
         $$variable = $value;
      }

      include( BASEPATH . "/views/" . $filename . ".php" );
   }
}
