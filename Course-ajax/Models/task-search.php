<?php
    require_once 'Conexion.php';
    $db=Conexion::conexion();
    $search = $_POST['search'];
    if(isset($search)){

        $instruccion= ("SELECT * FROM tareas WHERE nombre LIKE '%$search%'");
        $resultado=$db->prepare($instruccion);
        $resultado->execute(array());
        if(!$resultado){
            die ("Error en la consulta". $e->getmMessage());
            die ("Error en la line". $e->getLIne());
        }
        $json=array();
        
        while($row=$resultado->fetch(PDO::FETCH_ASSOC)){
            $json[]=array(
                'Id'=>$row['Id'],
                'Nombre'=>$row['Nombre'],
                'Descripcion'=>$row['Descripcion']
            );
        }

        $jsonstring=json_encode($json);
        echo $jsonstring;
    }