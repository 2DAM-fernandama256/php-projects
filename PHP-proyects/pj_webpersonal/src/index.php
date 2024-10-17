<?php

$pagina ="index";

require 'includes/hereder.php';

$agenda  =array(
     array(
        "nombre"=> "fernando",
        "apellidos"=>"amaya",
        "correo"=>"vdfgdgd"),

        array(
            "nombre"=> "fernando",
            "apellidos"=>"amaya",
            "correo"=>"vdfgdgd"),

            array(
                "nombre"=> "fernando",
                "apellidos"=>"amaya",
                "correo"=>"vdfgdgd")
    );
foreach($agenda as $clave => $valor){
    echo $valor["nombre"];
    echo $valor["apellidos"];
    echo $valor["correo"];
}

?>
<h2>Index</h2>
    
</body>
</html>