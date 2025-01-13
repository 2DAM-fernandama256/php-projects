<?php
 require './includes/data.php';

$array_aperc= getApercibimientos($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["eliminar"])) {

        $id_aper = $_POST["eliminar"];
        $checkDelete = eliminarApercibimientos($db, $id_aper);

        if ($checkDelete) {
            header("Location: index.php");
        }
    }
    elseif ((isset($_POST["editar"]))){
        $id_aper = $_POST["eliminar"];
    }

    elseif (isset($_POST["btnFiltrar"])) {
        if (isset($_POST["general"])) {
            $array_aperc = getApercibimientos($db, $_POST["general"] );
        }
    }
   
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Apercibimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Listado de Apercibimientos</h1>
    <form  method="post" action="">
                <select class="form-select" name="general">
                    <option selected disabled>Filtrar por...</option>
                    <option value="pendiente">pendiente</option>
                    <option value="resuelto">resuelto</option>
                    </select>
                <button type="submit" class="btn btn-success" name="btnFiltrar">Filtrar</button>
                
                <!-- Se redirige directamente al index, limpiando el filtro -->
                <a href="./index.php" class="btn btn-danger">Limpiar</a>
                
            </form>
    <div class="d-flex justify-content-end mb-3">

    

        <a class="btn btn-primary" href="crear.php">Nuevo Apercibimiento</a>
    </div>
    
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        
        </thead>
        <tbody>
        <?php foreach ($array_aperc as $c): ?>
                <tr>

                <td> <?= $c["id"] ?></td>
                <td> <?= $c["nombre"] ?></td>
                <td> <?= $c["fecha"] ?></td>
                <td> <?= $c["motivo"] ?></td>
                <td> <?= $c["estado"] ?></td>

                <form action="index.php" method="post">
                <td> <button type="submit" name="editar" value="<?= $c["id"] ?>"
                                class="btn btn-warning">
                                Editar
                    </button>
                    <button type="submit" name="eliminar" value="<?= $c["id"] ?>"
                                class="btn btn-danger ">
                                eliminar
                    </button>
                </td>
                </form>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
