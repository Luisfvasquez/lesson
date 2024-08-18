<?php
    require_once 'Conexion.php';
    $db=Conexion::conexion();

    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $description=$_POST['description'];
        $instrucccion="INSERT INTO tareas (nombre, descripcion) VALUES (:name, :description)";
        $resultado=$db->prepare($instrucccion);
        $resultado->execute(array(
            ':name'=>$name,
            ':description'=>$description
        ));
        if(!$resultado){
            die("Error en la consulta". $e->getMessage());
            die("Error en la linea". $e->getLine());
        }
        echo "Tarea agregada";
    }

?>