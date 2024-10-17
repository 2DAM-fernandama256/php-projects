<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Números</title>
</head>
<body>
    <h2>Ingresa un número:</h2>
    <form action="" method="POST">
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" required>
        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];

        if (is_numeric($numero)) {
            $numero = (float)$numero;

       
            if ($numero > 0) {
                echo "<p>El número $numero es positivo.</p>";
            } elseif ($numero < 0) {
                echo "<p>El número $numero es negativo.</p>";
            } else {
                echo "<p>El número ingresado es cero.</p>";
            }
        } else {
            echo "<p>Por favor, ingresa un número válido.</p>";
        }
    }
    ?>
</body>
</html>
