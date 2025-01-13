<?php
 require 'conexion.php';

 function getApercibimientos($db, $estados=null) {

     $sql = "";
    if($estados!=null){
         $sql = "SELECT a.id, al.nombre, a.fecha, a.motivo, a.estado FROM apercibimientos a inner join alumnos al on al.id = a.alumno_id where estado= '$estados';";
    }else{
        $sql = "SELECT a.id, al.nombre, a.fecha, a.motivo, a.estado FROM apercibimientos a inner join alumnos al on al.id = a.alumno_id ;";
    }
     
         
     

     $comp = mysqli_query($db, $sql);
     $resultado = array();

     if ($comp && mysqli_num_rows($comp) >= 1) {
         while ($c = mysqli_fetch_assoc($comp)) {
             array_push($resultado, $c);
         }
     }
     
     return $resultado;
 }

 function getAlumnos($db) {

    $sql = "";

    
        $sql = "SELECT nombre , id FROM  alumnos ;";
    

    $comp = mysqli_query($db, $sql);
    $resultado = array();

    if ($comp && mysqli_num_rows($comp) >= 1) {
        while ($c = mysqli_fetch_assoc($comp)) {
            array_push($resultado, $c);
        }
    }
    
    return $resultado;
}

 function eliminarApercibimientos($db, $id_aper){
    $check = false;

    $sqlInscripcion = "DELETE FROM apercibimientos 
                       WHERE id = $id_aper;";
    $query1 = mysqli_query($db, $sqlInscripcion);


    if ($query1 ) {
        $check = true;
    }

    return $check;
}

function addApercibimientos($db, $alumno_id, $fecha, $motivo, $estado)
{
    $check = false;

    $sqlInsert = "INSERT INTO apercibimientos ( alumno_id, fecha, motivo, estado) 
    VALUES ( '$alumno_id', '$fecha', '$motivo', '$estado');";

    $query = mysqli_query($db, $sqlInsert);

    if ($query) {
        $check = true;
    }

    return $check;
}

?>