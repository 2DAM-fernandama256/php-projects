<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Salario Neto</title>
</head>

<body>
    <h1>Calculadora de Salario Neto</h1>

   
    <form method="POST" action="">
        <label for="salario">Salario Bruto Mensual:</label>
        <input type="number" id="salario" name="salario" step="0.01" required>
        <br><br>

        <label for="retencion">Retención (%) :</label>
        <input type="number" id="retencion" name="retencion" step="0.01" required>
        <br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $salario_bruto = $_POST['salario'];
        $retencion = $_POST['retencion'];

      
        $salario_neto = $salario_bruto - ($salario_bruto * ($retencion / 100));

 
        echo "<h2>Resultado:</h2>";
        echo "<p>Tu salario neto es: $" . number_format($salario_neto, 2) . "</p>";
    }
    ?>
</body>
</html>
