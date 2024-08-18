<?php
    require_once 'Conexion.php';
    $db=Conexion::conexion();

    if(isset($_POST['id'])){
        $id=$_POST['id'];

        $instruccion="DELETE FROM tareas WHERE id=:id";

        $resultado=$db->prepare($instruccion);
        $resultado->execute(array(
            ':id'=>$id
        ));

        if(!$resultado){
            die("Error en la consulta". $e->getMessage());
            die("Error en la linea". $e->getLine());
        }

        echo "Tarea eliminada";
    }

    
    
?>