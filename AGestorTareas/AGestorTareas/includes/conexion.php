<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "gestion";

$bd= mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

if (!$bd){
    die("Conexion fallida: ".mysqli_connect_error());
}else{
    echo "funciona";
}
?>