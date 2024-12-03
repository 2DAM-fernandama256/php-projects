<?php
require 'conexion.php';

function getUsers($db){
    $sql="SELECT nombre_usuario, email, password, is_admin From usuarios";
    $usuarios = mysqli_query($db, $sql);

    $resultado = array();
    if ($usuarios && mysqli_num_rows($usuarios) >= 1){
        while ($user = mysqli_fetch_assoc($usuarios)){
            array_push($resultado, $user);
        }
    }
    return $resultado;
}


?>
