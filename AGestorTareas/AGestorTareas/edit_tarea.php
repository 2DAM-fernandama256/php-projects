<?php
require './includes/data.php';
require './includes/header.php';

// Verificar si el usuario está logueado, de lo contrario redirigir a login.php
/*session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
*/
$tarea_editar=[];
if (isset($_POST['tarea_id'])) {
  //Obtener la información de la tarea que queremos editar -> getTareas
} else {
    header('index.php');
}

if (isset($_POST['guardarCambios'])) {
    //Recogemos toda la información de las tareas del formulario.
  
    //Llamamos a nuestro guardarCambiosTarea.
  
}

?>

<body>
    <div class="d-flex justify-content-end m-2">
        <form action="index.php" method="post"> 
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>

    <form id="editTarea" method="post" action="" class="p-3 border rounded shadow bg-white">
        <input type="hidden" name="id_tarea" value="<?= $tarea_editar[0]['id']; ?>">

        <!-- Campo de Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título</label>
            <input type="text" class="form-control form-control-lg" id="titulo" name="titulo"
                value="" placeholder="Escribe el título de la tarea" required>
        </div>

        <!-- Campo de Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" rows="4"
                placeholder="Describe la tarea" required></textarea>
        </div>

        <!-- Campo de Fecha de Entrega -->
        <div class="mb-3">
            <label for="fecha_entrega" class="form-label fw-bold">Fecha de Entrega</label>
            <input type="date" class="form-control form-control-lg" id="fecha_entrega" name="fecha_entrega"
                value="" required>
        </div>

        <!-- Campo de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label fw-bold">Estado</label>
            <select class="form-select form-select-lg" id="estado" name="estado" required>
                <option value="to_do">Pendiente</option>
                <option value="doing">En progreso</option>
                <option value="done">Completada</option>
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" name="guardarCambios" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</body>