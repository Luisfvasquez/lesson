<?php  
    require_once 'Conexion.php';
    
    $db=Conexion::conexion();
    
    $id=$_POST['id'];
    
    $instruccion="SELECT * FROM tareas WHERE Id=:id";
    
    $resultado=$db->prepare($instruccion);
    $resultado->execute(array(
        ':id'=>$id
    ));
   
    if(!$resultado){
        die("Error en la consulta". $e->getMessage());
        die("Error en la linea". $e->getLine());
    }
    
    $json=array();
    while($row=$resultado->fetch(PDO::FETCH_ASSOC)){
        $json[]=array(
            'Id'=>$row['Id'],
            'Nombre'=>$row['Nombre'],
            'Descripcion'=>$row['Descripcion']
        );
    }
    
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;