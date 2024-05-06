<?php
    require('C:\xampp\htdocs\biblioteca2\back-end\includes/Database.class.php');

    class libro{
        public static function create_libro($nombre, $genero, $autor, $capitulos){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('INSERT INTO libro(nombre, genero, autor, capitulos) VALUES(:nombre, :genero, :autor, :capitulos)');
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':capitulos', $capitulos);
        
            if ($stmt->execute()) {
                header('HTTP/1.1 201 Created');
                echo json_encode(array("message" => "libro creado correctamente."));
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array("message" => "Error al crear el libro."));
            }
        }
        
        public static function delete_libro($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM libro WHERE id=:id');
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(array("message" => "El libro se borró exitosamente"));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "No se pudo borrar el libro"));
            }
        }
        


        public static function get_all_libro(){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM libro');
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }
        public static function get_id_libro($id){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM libro WHERE id = :id');
            $stmt->bindParam(':id',$id);
            
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }


        public static function update_libro($id, $nombre, $genero, $autor,$capitulos){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('UPDATE libro SET nombre=:nombre, genero=:genero, autor=:autor, capitulos=:capitulos WHERE id=:id');
        
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':capitulos', $capitulos);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                header('HTTP/1.1 201 El libro se actualizo correctamente');
                echo json_encode(array("message" => "libro actualizado correctamente."));
            } else {
                header('HTTP/1.1 401 El libro no se pudo actualizar');
                echo json_encode(array("message" => "Nose pudo actualizar lel libro."));
            }
        }
        
        
    }


?>