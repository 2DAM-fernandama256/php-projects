<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <h1>Contacto</h1>
    <form action="" method="post" class="row g-3 p-4">
        <div class="col-12 col-md-6">
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" name="nombre">
        </div>
        <div class="col-12 col-md-6">
            <label for="inputApellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="inputApellidos" name="apellidos">
        </div>
        <div class="col-12 col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email">
        </div>
        <div class="col-md-6 col-12">
            <div class="row p-2">
                <label>Indica si eres mayor de edad</label>
                <div class="col-6 form-check">
                    <input class="form-check-input" type="radio" name="radioMayorEdad" id="radioMayorEdad"
                        value="simayor">
                    <label class="form-check-label" for="radioMayorEdad">Sí, soy mayor de edad</label>
                </div>
                <div class="col-6 form-check">
                    <input class="form-check-input" type="radio" name="radioMayorEdad" id="radioNoMayorEdad"
                        value="nomayor" checked>
                    <label class="form-check-label" for="radioNoMayorEdad">No, soy menor de edad</label>
                </div>
            </div>
        </div>



        <div class="col-md-6 col-12">
            <label for="inputState" class="form-label">Cómo contactarnos</label>
            <select name="contacto" id="inputState" class="form-select">
                <option selected>Elige...</option>
                <option value="telefono">Por teléfono</option>
                <option value="email">Por email</option>
            </select>
        </div>
        <div class="col-md-6 col-12">
            <label for="inputState" class="form-label">Qué gustos compartimos</label>
            <select id="inputState" class="form-select" multiple="true" name="hobbies[]">
                <option value="futbol">Fútbol</option>
                <option value="pintura">Pintura</option>
                <option value="cocinar">Cocinar</option>
            </select>
        </div>
        <div class="col-12">
            <input type="checkbox" name="lenguajes[]" value="c"> C <br />
            <input type="checkbox" name="lenguajes[]" value="java"> Java<br />
            <input type="checkbox" name="lenguajes[]" value="php"> Php<br />
            <input type="checkbox" name="lenguajes[]" value="python"> Python<br />
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>



    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validación formulario
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $correo = $_REQUEST['email'];
        $mayorEdad = $_REQUEST['radioMayorEdad'];
        $contacto = $_REQUEST['contacto'];

        if (empty($nombre) || empty($apellidos) || empty($correo) || empty($mayorEdad)) {
            echo "<div class='alert alert-danger mt-4 text-center' role='alert'>Por favor, rellene todos los campos</div>";
        } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger mt-4 text-center' role='alert'>Por favor, indique un correo en el formato correcto.</div>";
        } else {
            echo "<div class='alert alert-success mt-4 text-center' role='alert'>Datos enviados correctamente.</div>";
        }

        // Para comprobar que lo recoge correctamente
        $hobbies = $_REQUEST['hobbies'];
        foreach ($hobbies as $h) {
            echo $h . "<br>";
        }

        echo "<hr>";
        echo $contacto;
        echo "<hr>";
        $lenguajes = $_REQUEST['lenguajes'];
        foreach ($lenguajes as $len) {
            echo $len . "<br>";
        }
    }
    ?>


</body>

</html>