<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Texto con Etiquetas H</title>
</head>
<body>
    <h2>Ingresa un texto para dibujarlo con diferentes tamaños de encabezados:</h2>
    
    <form action="" method="POST">
        <label for="texto">Texto:</label>
        <input type="text" id="texto" name="texto" required>
        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $texto = htmlspecialchars($_POST['texto']);

      
        echo "<h3>Resultado:</h3>";
        for ($i = 1; $i <= 6; $i++) {
            echo "<h$i>$texto</h$i>";
        }
    }
    ?>
</body>
</html>
