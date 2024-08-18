<?php
    require_once 'Conexion.php';
    $db=Conexion::conexion();

    $instruccion="SELECT * FROM tareas";
    $resultado=$db->prepare($instruccion);
    $resultado->execute(array());

    if(!$resultado){
        die("Error en la consulta". $e->getMessage());
        die("Error en la linea". $e->getLine());
    }

    $json=array();
    while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
        $json[]=array(
            'Id'=>$fila['Id'],
            'Nombre'=>$fila['Nombre'],
            'Descripcion'=>$fila['Descripcion']
        );
    }
    
    $jsonString=json_encode($json);
    echo $jsonString;
?>