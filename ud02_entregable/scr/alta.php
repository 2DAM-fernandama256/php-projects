<?php  
session_start();

// Verificación de sesión
if (!isset($_SESSION['login'])) {
    header('Location: ./login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Alta</title>
  
</head>
<body>

<div class="container text-center mb-4">
    <div class="d-flex justify-content-center align-items-center bg-custom py-3">
        <img src="img/martinez.png" class="rounded-circle me-3" width="50" height="50" alt="Foto de perfil">
        <h1 class="mb-0">Gestin de alta</h1>
    </div>
</div>

<?php  
$pagina = "alta";
require 'includes/header.php';

// Inicializamos la variable de selección
$opcion = isset($_GET["opcion"]) ? $_GET["opcion"] : 0;

// Formulario de selección de tipo de usuario
if ($opcion == 0 || $opcion == 3) {
    //lo que aparece antes de eleguir un profesor o alumno 
    if ($opcion == 3) {
        echo "<div class='alert alert-danger mt-4 text-center' role='alert'>Selección no válida.</div>";
    }
    echo "
    <div class='container text-center my-4'>        
        <h1 class='text-center mb-4'>Alta usuarios</h1>        
        <label for='inputOption' class='form-label'>Seleccione el tipo de usuario que desea dar de alta:</label>        
        <form action='alta.php' method='GET' class='row g-3 justify-content-center'>
            <div class='col-6'>
                <select name='opcion' class='form-select' aria-label='Default select example'>
                    <option selected value='3'>Elige</option>
                    <option value='1'>Alumno</option>
                    <option value='2'>Profesor</option>    
                </select> 
            </div>
            <div class='col-auto'>
                <button type='submit' class='btn btn-primary'>Elige</button>
            </div>            
        </form>          
    </div>";
} 

// Formulario para alta de alumnos
else if ($opcion == 1)  {
    echo "         
    <div class='container my-4'>
        <h1 class='text-center mb-4'>Alta Alumno</h1>
        <form action='index.php' method='POST' class='row g-3'>
            <input type='hidden' name='tipo_usuario' value='alumno'>
            <div class='col-md-6'>
                <label for='inputNombre' class='form-label'>Nombre</label>
                <input type='text' class='form-control' id='inputNombre' name='nombre' required>
            </div>
            <div class='col-md-6'>
                <label for='inputApellidos' class='form-label'>Apellidos</label>
                <input type='text' class='form-control' id='inputApellidos' name='apellidos' required>
            </div>
            <div class='col-md-6'>
                <label for='inputEmail' class='form-label'>Email</label>
                <input type='email' class='form-control' id='inputEmail' name='email' required>
            </div>
            <div class='col-md-6'>
                <label class='form-label'>Curso:</label>
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='curso[]' value='primer' id='curso1' checked>
                    <label class='form-check-label' for='curso1'>1º DAM</label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='curso[]' value='segundo' id='curso2'>
                    <label class='form-check-label' for='curso2'>2º DAM</label>
                </div>
            </div>
            <div class='col-12 text-center'>
                <button type='submit' class='btn btn-success'>Dar alta</button>
            </div>
        </form>
    </div>";
} 

// Formulario para alta de profesores
else if ($opcion == 2) {
    echo "        
    <div class='container my-4'>
        <h1 class='text-center mb-4'>Alta Profesor</h1>
        <form action='profesores.php' method='POST' class='row g-3'>
            <input type='hidden' name='tipo_usuario' value='profesor'>
            <div class='col-md-6'>
                <label for='inputNombre' class='form-label'>Nombre</label>
                <input type='text' class='form-control' id='inputNombre' name='nombre' required>
            </div>
            <div class='col-md-6'>
                <label for='inputApellidos' class='form-label'>Apellidos</label>
                <input type='text' class='form-control' id='inputApellidos' name='apellidos' required>
            </div>
            <div class='col-md-6'>
                <label for='inputEmail' class='form-label'>Email</label>
                <input type='email' class='form-control' id='inputEmail' name='email' required>
            </div>                
            <div class='col-md-6'>
                <label class='form-label'>Departamento:</label>
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='departamento[]' value='comercio' id='departamento1' checked>
                    <label class='form-check-label' for='departamento1'>Comercio</label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='departamento[]' value='informatica' id='departamento2'>
                    <label class='form-check-label' for='departamento2'>Informática</label>
                </div>
            </div>
            <div class='col-12 text-center'>
                <button type='submit' class='btn btn-success'>Dar alta</button>
            </div>
        </form>
    </div>";
}    
?>
</body>
</html>
