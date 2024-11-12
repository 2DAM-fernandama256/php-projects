<?php
session_start();

// Verifica si el usuario esta logueado
if (!isset($_SESSION['login'])) {
    header('Location: ./login.php');
    exit;
}

// Datos de los alumnos
$alumnos = [
    ['id' => 'Alumno1','nombre' => 'alberto', 'correo' => 'alberto@gmail.com', 'curso' => '2 DAM'],
    ['id' => 'Alumno2','nombre' => 'francisco', 'correo' => 'francisco@gmail.com', 'curso' => '2 DAM'],
    ['id' => 'Alumno3','nombre' => 'mateo', 'correo' => 'mateo@gmail.com', 'curso' => '2 DAM'],
    ['id' => 'Alumno4','nombre' => 'nacho', 'correo' => 'nacho@gmail.com', 'curso' => '2 DAM'],
    ['id' => 'Alumno5','nombre' => 'serguio', 'correo' => 'serguio@gmail.com', 'curso' => '1 DAM'],
    ['id' => 'Alumno6','nombre' => 'antonio', 'correo' => 'antonio@gmail.com', 'curso' => '1 DAM'],
    ['id' => 'Alumno7','nombre' => 'eduardo', 'correo' => 'eduardo@gmail.com', 'curso' => '1 DAM']
];

$alumno_encontrado = null;
$mensaje_busqueda = "";

// Validar búsqueda
if (isset($_POST['buscar'])) {
    $nombre_buscado = strtolower(trim($_POST['nombre'])); //entrada 
    foreach ($alumnos as $alumno) {
        if (strtolower($alumno['nombre']) === $nombre_buscado) {
            $alumno_encontrado = $alumno;
            $mensaje_busqueda = "Alumn@ {$alumno['nombre']} está en la lista";
            break;
        }
    }
    if (!$alumno_encontrado) {
        $mensaje_busqueda = "Alumn@ {$nombre_buscado} no está en la lista";
    }
}

// Ruta del directorio de carga
$uploadDir = __DIR__ . '/src/files_loaded/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Descargar todos los alumnos
if (isset($_POST['descargar_todo'])) {
    $filePath = $uploadDir . 'todos_alumnos.txt';
    $file = fopen($filePath, 'w');
    foreach ($alumnos as $alumno) {
        fwrite($file, "ID: {$alumno['id']}, Nombre: {$alumno['nombre']}, Correo: {$alumno['correo']}, Curso: {$alumno['curso']}\n");
    }
    fclose($file);

    // Redefinir encabezados
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="todos_alumnos.txt"');
    readfile($filePath);
    exit;
}

// Descargar un solo alumno
if (isset($_POST['export_single']) && isset($_POST['alumno_id'])) {
    $alumno_id = $_POST['alumno_id'];
    foreach ($alumnos as $alumno) {
        if ($alumno['id'] === $alumno_id) {
            $filePath = $uploadDir . "alumno_{$alumno_id}.txt";
            $file = fopen($filePath, 'w');
            fwrite($file, "ID: {$alumno['id']}, Nombre: {$alumno['nombre']}, Correo: {$alumno['correo']}, Curso: {$alumno['curso']}\n");
            fclose($file);

            header('Content-Type: text/plain');
            header("Content-Disposition: attachment; filename=\"alumno_{$alumno_id}.txt\"");
            readfile($filePath);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Alumnos</title>
</head>
<body>
<div class="container text-center mb-4">
    <div class="d-flex justify-content-center align-items-center bg-custom py-3">
        <img src="img/martinez.png" class="rounded-circle me-3" width="50" height="50" alt="Foto de perfil">
        <h1 class="mb-0">Gestion de alumnos</h1>
        <br>
    </div>
</div>
<div class="container text-center mb-4">

    <?php
    $pagina = "index";
    require 'includes/header.php';
    ?>

    <h1 class="text-center mb-4 p-4">Alumnado</h1>

    <!-- Formulario de búsqueda -->
    <form method="post" class="mb-4">
        <label class="col-sm-2">Nombre del alumno a buscar</label>
        <div class="input-group mb-4">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del alumno a buscar" required>
        </div>
        <div class="input-group">
            <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <!-- Botón para descargar todos los alumnos -->
    <form method="post" class="mb-4">
        <div class="input-group d-flex justify-content-end">
            <button type="submit" name="descargar_todo" class="btn btn-warning">Descargar Todo</button>
        </div>
    </form>

    <!-- Mensaje de búsqueda -->
    <?php if ($mensaje_busqueda): ?>
        <h3 class="col-sm-4 <?= $alumno_encontrado ? 'text-success' : 'text-danger' ?>"><?= htmlspecialchars($mensaje_busqueda) ?></h3>
    <?php endif; ?>

    <!-- Tabla de alumnos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Curso</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                    <td><?= htmlspecialchars($alumno['correo']) ?></td>
                    <td><?= htmlspecialchars($alumno['curso']) ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="alumno_id" value="<?= htmlspecialchars($alumno['id']) ?>">
                            <button type="submit" name="export_single" class="btn btn-info">
                                <!-- Icono SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 11l5 5l5 -5" />
                                    <path d="M12 4l0 12" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>        
</body>
</html>
