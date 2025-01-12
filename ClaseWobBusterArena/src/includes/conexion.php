<?php

    // Datos para la conexión
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $base_datos = "crossfit";

    // Se realiza la conexión
    $db = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);    

    // Se verifica la conexión
    if (!$db)
        die("Error en la conexión: " . mysqli_connect_error());

?>