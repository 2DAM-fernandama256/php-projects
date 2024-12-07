<?php
session_start();
require './includes/data.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_libro'])) {
    if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
        $id_usuario = $_SESSION['id_usuario']; // El ID del usuario almacenado en la sesión
        $id_libro = intval($_POST['id_libro']); // ID del libro recibido del formulario

        // Preparar la inserción en la tabla reservas
        $sql = "INSERT INTO reservas (id_usuario, id_libro) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $id_usuario, $id_libro);

        if ($stmt->execute()) {
            // Redirigir con un mensaje de éxito
            
            header("Location: index.php?msg=Reserva realizada con éxito");
        } else {
            // Manejar error
            header("Location: index.php?msg=Error al realizar la reserva");
        }
        $stmt->close();
    } else {
        header("Location: login.php");
            exit();
    }
    exit();
}
?>