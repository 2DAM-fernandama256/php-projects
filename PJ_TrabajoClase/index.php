<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        <?php
        echo "<h1>hola mundo</h1>";
        $nombre="Fernando";
       
        $apellidos="Amaya";
        echo "Mi nombre es  ".$nombre." ".$apellidos;
        echo "<br>";
        $nombre="Hector";
        echo "Mi nombre es $nombre $apellidos";

        $edad=19;
        var_dump (trim($edad)) ;
        var_dump (trim($nombre));
        const pi=3.14;
        
    
        ?>
    </p>



</body>
</html>