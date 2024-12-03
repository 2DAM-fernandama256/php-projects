<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "biblioteca_virtual";

// Crear conexión
$conn = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);


// Verificar conexión
if ($conn->connect_error){
    die ("error en la conexion: ". $conn->connect_error);
}
    echo "conexion exitosa";

?>