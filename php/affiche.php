<?php 


$file =  dirname(__FILE__);
$pieces = explode("wp-content", $file);


include_once($pieces[0].'wp-content/plugins/menu_header/php/sql.php');

class afficher extends sql{

    function affiche_page($id){

        $page = $this->select_page("page","post_content",$id);

         echo "<div>";

         print_r($page[0]);
       
         echo "</div>";
    }

}

?>