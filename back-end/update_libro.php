<?php
require('C:\xampp\htdocs\biblioteca2\back-end/includes/libro.class.php');


parse_str(file_get_contents("php://input"), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_PUT['id'] ) && isset($_PUT['nombre']) && isset($_PUT['genero']) && isset($_PUT['autor']) && isset($_PUT['capitulos']) ) {
    libro::update_libro($_PUT['id'], $_PUT['nombre'], $_PUT['genero'], $_PUT['autor'], $_PUT['capitulos']);
} else {
    echo 'No se han proporcionado todos los datos necesarios para la actualización';
}

?>
