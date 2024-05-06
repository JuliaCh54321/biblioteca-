<?php
    require('includes/libro.class.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($_GET['id'])) {
          
         libro::get_id_libro($_GET['id']);
        
    }else{
        echo 'Nose envio el Id';
    }


?>