<?php

$pagina = "index";
require 'includes/hereder.php';

$agenda = array(
    array(
        "nombre" => "Fernando",
        "apellidos" => "Amaya",
        "correo" => "fernando.amaya@example.com"
    ),
    array(
        "nombre" => "Lucía",
        "apellidos" => "Fernández",
        "correo" => "lucia.fernandez@example.com"
    ),
    array(
        "nombre" => "Miguel",
        "apellidos" => "García",
        "correo" => "miguel.garcia@example.com"
    )
);

foreach ($agenda as $contacto) {
    echo $contacto["nombre"] . " ";
    echo $contacto["apellidos"] . " - ";
    echo $contacto["correo"] . "<br>";
}

?>

<h2>Index</h2>

</body>
</html>
