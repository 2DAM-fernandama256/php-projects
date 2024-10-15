<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Edad</title>
</head>
<body>
    <h1>Ingrese su Nombre y Edad</h1>

    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];

        echo "<h2>Hola, $nombre.</h2>";

        if ($edad >= 18) {
            echo "<p>Eres mayor de edad.</p>";
        } else {
            echo "<p>No eres mayor de edad.</p>";
        }
    }
    ?>
</body>
</html>
