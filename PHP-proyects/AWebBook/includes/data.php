<?php
require 'conexion.php';
//funcion para recoger a los usuarios
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
//funcion para recoger las reservas de cada usuario 
function getReservas($db, $nombreUsuario) {
	$sql = "SELECT l.titulo, r.fecha_reserva
    FROM libros l JOIN reservas r ON l.id_libro = r.id_libro 
	JOIN usuarios u ON r.id_usuario = u.id_usuario
    WHERE u.nombre_usuario = '$nombreUsuario';";

	$reservas = mysqli_query($db, $sql);
	
	$resultado = array();
	if ($reservas && mysqli_num_rows($reservas) >= 1) {
		while ($reserva = mysqli_fetch_assoc($reservas)) 
			array_push($resultado, $reserva);  
	}	

	return $resultado;
}


?>
