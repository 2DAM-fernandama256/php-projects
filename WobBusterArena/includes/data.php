<?php
require 'conexion.php';
function getUsers($db){
	$sql = "SELECT id_usuario, nombre, password, rol FROM Usuarios;";
	$usuarios = mysqli_query($db, $sql);

	$resultado = array();
	if ($usuarios && mysqli_num_rows($usuarios) >= 1) {
		while ($user = mysqli_fetch_assoc($usuarios)) {
			array_push($resultado, $user);
		}
	}

	return $resultado;
}


function getcompeticiones($db, $nombreCategoria = null) {
	$sql = $nombreCategoria != null ?
    "SELECT id_campeonato, nombre, fecha, ciudad, provincia, precio, imagen, cerrado
    FROM campeonatos  
    WHERE provincia = '$nombreCategoria';"
	:
    "SELECT id_campeonato, nombre, fecha, ciudad, provincia, precio, imagen, cerrado
    FROM campeonatos  ";

	$campeonatos = mysqli_query($db, $sql);
	
	$resultado = array();
	if ($campeonatos && mysqli_num_rows($campeonatos) >= 1) {
		while ($campeonato = mysqli_fetch_assoc($campeonatos)) 
			array_push($resultado, $campeonato);  
	}	

	return $resultado;
}

function eliminarCampeonato($db, $id) {
	$sql = "DELETE FROM campeonatos WHERE id_campeonato = $id;";
	mysqli_query($db, $sql);
}


function getReservas($db, $nombreUsuario = null) {
	$sql = $nombreUsuario != null ?
	"SELECT l.id_campeonato , l.nombre , l.fecha
    FROM campeonatos l JOIN Inscripciones r ON l.id_campeonato  = r.id_campeonato  
	JOIN usuarios u ON r.id_usuario = u.id_usuario
    WHERE u.nombre = '$nombreUsuario';"
	:
	"SELECT l.id_campeonato , l.nombre , l.fecha
    FROM campeonatos l JOIN Inscripciones r ON l.id_campeonato  = r.id_campeonato  
	JOIN usuarios u ON r.id_usuario = u.id_usuario";

	$reservas = mysqli_query($db, $sql);
	
	$resultado = array();
	if ($reservas && mysqli_num_rows($reservas) >= 1) {
		while ($reserva = mysqli_fetch_assoc($reservas)) 
			array_push($resultado, $reserva);  
	}	

	return $resultado;
}


function insertarCompe($db, $nombre, $fecha, $ciudad, $provincia,$precio, $cerrado, $imagen) {

	$sql = !empty($imagen) ?
	"INSERT INTO campeonatos  (nombre, fecha, ciudad, provincia, precio, imagen, cerrado)
	VALUES ($nombre, '$fecha', '$ciudad', $provincia, $precio, '$imagen', '$cerrado')"
	:
	"INSERT INTO libros (id_libro, titulo, autor, id_categoria, disponible, imagen)
		VALUES ($nombre, '$fecha', '$ciudad', $provincia, $precio, './img/iron.png', '$cerrado')";

	return mysqli_query($db, $sql);
}


function reservarcompe($db, $nombreUsuario, $idcompe) {

	$sql = "SELECT id_usuario, nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombreUsuario'";

	$resultado = mysqli_query($db, $sql);
	$idUsuario = $resultado->fetch_row()[0];


	$sql = "INSERT INTO inscripciones ( id_usuario , id_campeonato) 
	VALUES ( $idUsuario,$idcompe );";
	mysqli_query($db, $sql);

	$sql = "UPDATE campeonatos  SET disponible = 0 WHERE id_campeonato = $idcompe;";
	mysqli_query($db, $sql);
}

?>