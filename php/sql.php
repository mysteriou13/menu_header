<?php

class sql{

    function __construct(){


      $file =  dirname(__FILE__);

        $pieces = explode("wp-content", $file);
      
        include($pieces[0]."/wp-config.php");
        
        define( 'db_menu', $table_prefix."menu");

        define( 'prefix', $table_prefix);

         $this->create_table_menu();

         if(current_user_can('administrator')) {
         $this->select_menu();
         }

        $this->affiche_menu();

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


 echo "<div><a href ='".$row->name."'>".$row->link."</a></div>";

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


    function select_page($type,$data,$id){

      global $wpdb;
      
    
       $post =   prefix."posts";
      
       $liste_page = $wpdb->get_results("SELECT $data FROM  $post WHERE   id = $id ");
      
      $tab = [];
      
      foreach ($liste_page as $row) {
      
        
      $a = $row->$data;
      
      array_push($tab, $a);
      
      
      }
      
      return $tab;
      
      }


      function select_menu(){

        $listepage = $this->liste_page("page","post_title");

        $listeid = $this->liste_page("page","ID");

          $nblistepage = count($listepage)-1;

          $nblisteid = count($listeid)-1;

         
           echo "<form action = './' method = 'post'>";

          echo 'choisir la page  <SELECT name="link_menu" size="1">';

          $nb = -1;

          while($nb <= $nblistepage -1){

            $nb++;

            echo "<OPTION value ='".$listeid[$nb]."'>".$listepage[$nb];

          }

          echo '<SELECT>';

         echo 'nom du lien <input type = "text" name = "name_link"> ';    
            echo " <input type = 'submit'></form>";

            if(isset($_POST['link_menu']) && isset($_POST['name_link'])){

              $this->add_el_menu($_POST['name_link'],$_POST['link_menu']);
        
            }
      }

}


?>