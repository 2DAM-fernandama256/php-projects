<?php
require 'conexion.php';
function getTareas($bd)
{
    $sql = "SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t;";
    $tareas = mysqli_query($bd, $sql);

    $resultado = array();

    if($tareas && mysqli_num_rows($tareas) > 0){
        while($tarea = mysqli_fetch_assoc($tareas)){
            array_push($resultado, $tarea);
        }
    }

    return $resultado; 
}
?>
