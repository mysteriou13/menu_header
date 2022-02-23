<?php

class sql{

    function __construct(){

        include("../../../wp-config.php");

        define( 'db_menu', $table_prefix."menu");

         $this->create_table_menu();

    }
    function create_table_menu(){


      global $wpdb;
    
      $charset_collate = $wpdb->get_charset_collate();
    
       $table_name = db_menu;
    
      $sql = "
      CREATE TABLE IF NOT EXISTS `new_wordpress`.$table_name ( `id` INT NOT NULL AUTO_INCREMENT , `link` TEXT NOT NULL , `name` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
      
      ";
    
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    
    }



function add_el_menu($name_menu,$link_menu){

  global $wpdb;

 $wpdb->insert(db_menu, array(
     "link" => $name_menu,
    "name" =>  $link_menu
     
  ))


}


}


?>