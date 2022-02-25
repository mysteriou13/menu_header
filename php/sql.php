<?php

class sql{

    function __construct(){

        include("../../../wp-config.php");

        define( 'db_menu', $table_prefix."menu");

        define( 'prefix', $table_prefix);

      
         $this->create_table_menu();

    }

    function create_table_menu(){


      global $wpdb;
    
      $charset_collate = $wpdb->get_charset_collate();
    
       $table_name = db_menu;
       $dbname =  DB_NAME;
    
      $sql = "
      CREATE TABLE IF NOT EXISTS $dbname ( `id` INT NOT NULL AUTO_INCREMENT , `link` TEXT NOT NULL , `name` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; 
      
      ";
    
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    
    }



function add_el_menu($name_menu,$link_menu){

  global $wpdb;

 $wpdb->insert(db_menu, array(
     "link" => $name_menu,
    "name" =>  $link_menu
     
 ));
 }

function affiche_menu(){

global $wpdb;


  $liste_menu = $wpdb->get_results("SELECT * FROM ".db_menu);

    echo "<div class = 'd-flex justify-content-around'>";

  foreach ($liste_menu as $row) {

  $page = "./admin.php?page=menu-gestion&menu=".$row->name;

 echo "<div><a href ='".$row->link."'>".$row->name."</a></div>";

  }

  echo "</div>";

  }


  function liste_page($type,$data){

    global $wpdb;
    
  
     $post =   prefix."posts";
    
     $liste_page = $wpdb->get_results("SELECT $data FROM  $post WHERE post_type = '$type' && post_status = 'publish'");
    
    $tab = [];
    
    foreach ($liste_page as $row) {
    
      
    $a = $row->$data;
    
    array_push($tab, $a);
    
    
    }
    
    return $tab;
    
    }

      


}


?>