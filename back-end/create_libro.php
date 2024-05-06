<?php
    
    require('C:\xampp\htdocs\biblioteca2\back-end\includes/libro.class.php');
    

    if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['nombre']) && isset($_POST['genero']) && isset($_POST['autor']) && isset($_POST['capitulos'])) {

        libro::create_libro($_POST['nombre'], $_POST['genero'], $_POST['autor'], $_POST['capitulos']);
        
    } else {
        echo 'No se encontraron todos los datos necesarios';
    }
?>
