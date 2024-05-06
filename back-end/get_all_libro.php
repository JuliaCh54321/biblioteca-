<?php
    require('includes/libro.class.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' ) {
          
         libro::get_all_libro();
        
        
    }


?>