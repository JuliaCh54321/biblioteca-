<?php
    require('C:\xampp\htdocs\biblioteca2\back-end/includes/libro.class.php');

    if ($_SERVER['REQUEST_METHOD'] =='DELETE' && isset($_GET['id'])) {
       
       
        libro::delete_libro($_GET['id']);
        
    }else{
        echo'No se envio el libro';
    }


?>