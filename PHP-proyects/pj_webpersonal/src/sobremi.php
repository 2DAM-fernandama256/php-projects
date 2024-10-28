<?php
$pagina = "sobremi";
require 'includes/hereder.php';

$hobbies = array(
    array("nombre" => "jugar", "descripcion" => "Se trata de jugar a videojuegos en el ordenador", "imagen" => "./videojuegos.jpeg", "veces_por_semana" => 4),
    array("nombre" => "cocinar", "descripcion" => "El arte de preparar y cocinar alimentos.", "imagen" => "./cocinar.avif", "veces_por_semana" => 6),
    array("nombre" => "gimnasio", "descripcion" => "Entrenar y fortalecer los músculos.", "imagen" => "./gimnasio.jpeg", "veces_por_semana" => 5)
);


function array_orderby($array, $key) {
    $columna=array_column($array, $key);
    array_multisort($columna, SORT_ASC, $array);
    return $array;
}
$hobbies_ord = array_orderby($hobbies, "veces_por_semana");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <?php
        foreach ($hobbies_ord as $hob) {
            $nombre = htmlspecialchars($hob["nombre"]);
            $desc = htmlspecialchars($hob["descripcion"]);
            $ref = htmlspecialchars($hob["imagen"]);
            $e = htmlspecialchars($hob["veces_por_semana"]);
            echo "
            <div class='col-md-4 mb-4'>
                <div class='card'>
                    <img src='$ref' class='card-img-top' alt='Image of $nombre'>
                    <div class='card-body'>
                        <h5 class='card-title'>$nombre</h5>
                        <p class='card-text'>$desc</p>
                        <a href='#' class='btn btn-primary'>$e veces por semana</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

</body>
</html>


