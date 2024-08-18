<?php
    require_once 'Conexion.php';
    $db=Conexion::conexion();

    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $nombre=$_POST['name'];
        $descripcion=$_POST['description'];

        $instruccion="UPDATE tareas SET Nombre=:nombre, Descripcion=:descripcion WHERE Id=:id";

        $resultado=$db->prepare($instruccion);
       $resultado->execute(array(":id"=>$id, ":nombre"=>$nombre, ":descripcion"=>$descripcion));

        if(!$resultado){
            die("Error en la consulta". $e->getMessage());
            die("Error en la linea". $e->getLine());
        }

        echo "Tarea actualizada";
    }

    
    
?>