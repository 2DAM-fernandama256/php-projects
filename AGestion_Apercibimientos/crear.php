<?php
require './includes/data.php';



$alumnos_array=getAlumnos($db);


if (isset($_POST['aniadir'])) {
    
    $id_alumno= $_POST['alumno'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];
    $estado = $_POST['estado'];

    //Llamamos a nuestro guardarCambiosTarea.
    $checkUpdate = addApercibimientos($db, $id_alumno, $fecha, $motivo, $estado);

    if ($checkUpdate) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Apercibimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Registrar Nuevo Apercibimiento</h1>

    <form action="crear.php" method="post">
        <!-- Selector de Alumno -->
        <div class="mb-3">
            <label for="alumno" class="form-label">Alumno</label>
            <select name="alumno" id="alumno" class="form-select" required>
                <option selected disabled>Seleccione un alumno</option>
                <?php foreach ($alumnos_array as $c): ?>
                <option value="<?= $c["id"] ?>"><?= $c["nombre"] ?></option>
            <?php endforeach; ?>
             
            </select>
        </div>
        <!-- Campo de Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label fw-bold">Fecha</label>
            <input type="date" class="form-control form-control-lg" id="fecha" name="fecha"
                value="fecha" required>
        </div>

        <!-- Campo de Motivo -->
        <div class="mb-3">
            <label for="ciudad" class="form-label fw-bold">Ciudad</label>
            <input type="text" class="form-control form-control-lg" id="motivo" name="motivo"
                value="motivo" placeholder="Escribe el motivo del apercibimientos" required>
        </div>
         <!-- Selector de Estado -->
         <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="pendiente">Pendiente</option>
                <option value="resuelto">Resuelto</option>
            </select>
        </div>

        <!-- Botón Guardar -->
        <div class="text-center">
            <button class="btn btn-success" name="aniadir">Guardar Apercibimiento</button>
            <a class="btn btn-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</div>

</body>
</html>
