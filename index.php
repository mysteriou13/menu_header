
<link href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div>

<?php 

$file =  dirname(__FILE__);
$pieces = explode("wp-content", $file);


include_once($pieces[0].'wp-content/plugins/menu_header/php/sql.php');

include_once($pieces[0].'wp-content/plugins/menu_header/php/affiche.php');


$sql = new sql();



$sql->start_menu();


?>

</div>