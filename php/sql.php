<?php

class sql{

    function __construct(){

        include("../../../wp-config.php");

        define( 'db_prefix', $table_prefix );

         $this->create_table_menu();

    }
    function create_table_menu(){


      global $wpdb;
    
      $charset_collate = $wpdb->get_charset_collate();
    
       $table_name = db_prefix."menu";
    
      $sql = "
      CREATE TABLE $table_name (
        `id` int NOT NULL,
        `name_link` text NOT NULL,
        `link` text NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
      
      
      ";
    
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    
    
    }



}


?>