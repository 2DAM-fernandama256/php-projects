<?php
    require './includes/data.php';
    require './includes/header.php';

    // Verificar si el usuario está logueado, de lo contrario redirigir a login.php
    //session_start();
    if ($_SESSION["rol"] != "administrador") {
        header("Location: index.php");
        exit();
    }

    $campeonato_editar = [];
    if (isset($_POST["id_campeonato"])) {
        //Obtener la información de la tarea que queremos editar -> getTareas
        $id_campeonato = $_POST["id_campeonato"];
        $campeonato_editar = getCompeticiones($db, $id_campeonato);
        //var_export($campeonato_editar);     

    } else {
        header("Location: index.php");
    }

    if (isset($_POST['guardarCambios'])) {
        //Recogemos toda la información de las tareas del formulario.
        $id_campeonato = $_POST['id_campeonato'];
        $nombre = $_POST['nombre'];
        $ciudad = $_POST['ciudad'];
        $provincia = $_POST['provincia'];
        $fecha = $_POST['fecha'];
        $registro = $_POST['registro'];

        //Llamamos a nuestro guardarCambiosTarea.
        $checkUpdate = guardarCambiosCampeonato($db, $id_campeonato, $nombre, $ciudad, $provincia, $fecha, $registro);

        if ($checkUpdate) {
            header("Location: index.php");
        }
    }

?>

<body>
    <div class="d-flex justify-content-end m-2">
        <form action="index.php" method="post"> 
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>

    <form id="editCompeticion" method="post" action="" class="p-3 border rounded shadow bg-white">
        <input type="hidden" name="id_campeonato" value="<?= $campeonato_editar[0]["id_campeonato"]; ?>">

        <!-- Campo de Título -->
        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre"
                value="<?= $campeonato_editar[0]['nombre']; ?>" placeholder="Escribe el nombre de la competición" required>
        </div>

        <!-- Campo de Provincia -->
        <div class="mb-3">
            <label for="provincia" class="form-label fw-bold">Provincia</label>
            <input type="text" class="form-control form-control-lg" id="provincia" name="provincia"
                value="<?= $campeonato_editar[0]['provincia']; ?>" placeholder="Escribe la provincia" required>
        </div>

        <!-- Campo de Ciudad -->
        <div class="mb-3">
            <label for="ciudad" class="form-label fw-bold">Ciudad</label>
            <input type="text" class="form-control form-control-lg" id="ciudad" name="ciudad"
                value="<?= $campeonato_editar[0]['ciudad']; ?>" placeholder="Escribe la ciudad de la competicion" required>
        </div>

        <!-- Campo de Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label fw-bold">Fecha</label>
            <input type="date" class="form-control form-control-lg" id="fecha" name="fecha"
                value="<?= $campeonato_editar[0]['fecha']; ?>" required>
        </div>

        <!-- Campo de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label fw-bold">Registro</label>
            <select class="form-select form-select-lg" id="registro" name="registro" required>
                <option value="0" <?= $campeonato_editar[0]['cerrado'] == 0 ? 'selected' : ''; ?>
                >Abierto</option>
                <option value="1" <?= $campeonato_editar[0]['cerrado'] == 1 ? 'selected' : ''; ?>
                >Cerrado</option>
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" name="guardarCambios" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</body>