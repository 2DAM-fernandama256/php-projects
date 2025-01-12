<?php
    require './includes/data.php';
    require './includes/header.php';

    $array_comp = getCompeticiones($db);
    $array_provincia = getProvincias($db);

    var_export($_SESSION["id_usuario"]);
    $usuario_rol = isset($_SESSION["rol"]) ? $_SESSION["rol"] : "nologued"; 

    $atleta_inscripciones = [];
    if ($usuario_rol == "atleta") {
        $atleta_inscripciones = getInscripciones($db, $_SESSION["id_usuario"]);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["eliminarCampeonato"])) {

            $id_campeonato = $_POST["eliminarCampeonato"];
            $checkDelete = eliminarCampeonato($db, $id_campeonato);

            if ($checkDelete) {
                header("Location: index.php");
            }
        }
        elseif (isset($_POST["id_campeonato"])) {
            $nombre = $_POST["nombre"];
            $ciudad = $_POST["ciudad"];
            $provincia = $_POST["provincia"];
            $fecha = $_POST["fecha"];
            $registro = $_POST["registro"];

            $checkInsert = addCampeonato($db, $nombre, $ciudad, $provincia, $fecha, $registro);

            if ($checkInsert) {
                header("Location: index.php");
            }
        }
        elseif (isset($_POST["btnFiltrar"])) {

            if (isset($_POST["general"]) && isset($_POST["provincia"])) {
                $array_comp = getCompeticiones($db, null, $_POST["general"], $_POST["provincia"], $_SESSION["id_usuario"]);
            }
            elseif (!isset($_POST["general"]) && isset($_POST["provincia"])) {
                $array_comp = getCompeticiones($db, null, null, $_POST["provincia"], $_SESSION["id_usuario"]);
            }
            elseif (isset($_POST["general"]) && !isset($_POST["provincia"])) {
                $array_comp = getCompeticiones($db, null, $_POST["general"], null, $_SESSION["id_usuario"]);
            }
        }
        // Controlar si se va a inscribir o desinscribir de un campeonato
        elseif (isset($_POST["apuntarInscri"])) {
            $checkInsert = addInscripcion($db, $_SESSION["id_usuario"], $_POST["id_camp"]);

            if ($checkInsert) {
                header("Location: index.php");
            }
        }
        elseif (isset($_POST["eliminarInscri"])) {
            $checkDelete = deleteInscripcion($db, $_POST["id_inscri"]);

            if ($checkDelete) {
                header("Location: index.php");
            }
        }
    }
?>  

<div class="container">      

    <div class="row m-4 justify-content-between">
        <?php if ($usuario_rol == "administrador"): ?>
            <div class="col-4 mb-3">
                <button type="submit" name="editar" data-bs-toggle="modal" data-bs-target="#addCompeticion"
                    class="btn btn-success">
                    Añadir Campeonato
                </button>
            </div>  
        <?php endif; ?>

        <div class="col-6">
            <form class="input-group" method="post" action="">
                <select class="form-select" name="general">
                    <option selected disabled>Filtrar por...</option>
                    <?php if ($usuario_rol == "atleta"): ?>
                        <option value="misComp">Mis Competiciones</option>
                    <?php endif; ?>
                    <option value="cerrado">Registro Abierto</option>
                    <option value="abierto">Registro Cerrado</option>
                </select>
                <select class="form-select" name="provincia">
                    <option disabled selected>Seleccione una provincia</option>
                    <?php foreach ($array_provincia as $p): ?>
                        <option value="<?= $p["provincia"] ?>"><?= $p["provincia"] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-success" name="btnFiltrar">Filtrar</button>
                <!-- Se redirige directamente al index, limpiando el filtro -->
                <a href="./index.php" class="btn btn-danger">Limpiar</a>
            </form>
        </div>
    </div>

    <div class="row">
        <?php foreach ($array_comp as $c): ?>
            <?php $is_Inscrito = in_array($c["id_campeonato"], array_column($atleta_inscripciones, "id_campeonato")); ?>

            <div class="card col-4">
                <img src="./img/<?= $c["imagen"] ?>" class="card-img-top" alt="<?= $c["imagen"] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $c["nombre"] ?></h5>
                    <p class="card-text">
                        <strong>Fecha: </strong><?= $c["fecha"] ?> <br>
                        <strong>Lugar: </strong><?= $c["provincia"] ?><br>
                        <strong>Precio: </strong><?= $c["precio"] ?>$
                    </p>

                    <?php if ($usuario_rol == "administrador"): ?>
                        <form action="<?= $c["cerrado"] == 1 ? 'editCompeticion.php' : ''?>" method="post">
                            <input type="hidden" name="id_campeonato" value="<?= $c["id_campeonato"] ?>">
                            <button type="submit" name="editar" 
                                class="btn btn-warning <?= $c["cerrado"] == 1 ? '' : 'disabled'?>">
                                Editar
                            </button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="eliminarCampeonato" value="<?= $c["id_campeonato"] ?>">
                            <button type="submit" class="btn btn-danger <?= $c["cerrado"] == 0 ? '' : 'disabled'?>">
                                Eliminar
                            </button>
                        </form>                      
                    <?php elseif ($usuario_rol == "atleta"): ?>
                        <form action="" method="post">

                            <input type="hidden" name="id_inscri" value="<?= $atleta_inscripciones[$is_Inscrito]['id_inscripcion'] ?>">

                            <input type="hidden" name="id_camp" value="<?= $c["id_campeonato"] ?>">

                            <button name="<?= $is_Inscrito != null ? "eliminarInscri" : "apuntarInscri"?>" 
                                class="btn <?= $is_Inscrito != null ? "btn-danger" : "btn-success"?> 
                                <?= $c["cerrado"] == 1 ? "" : "disabled" ?>">
                                <?= $is_Inscrito != null ? "Borrarse" : "Inscribirse"?>
                            </button>

                            
                        </form>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Inscribirse
                        </button>

                    <?php endif; ?>
                    <button class="btn btn-secondary"><?= $c["cerrado"] == 0 ? 'Registro Cerrado' : 'Registro Abierto' ?></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="addCompeticion"
    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"
                    id="staticBackdropLabel">Nuevo Campeonato</h1>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="" class="p-3 border rounded shadow bg-white">
                <input type="hidden" name="id_campeonato">

                <!-- Campo de Título -->
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control form-control-lg" id="nombre" name="nombre"
                        placeholder="Escribe el nombre del campeonato" required>
                </div>

                <!-- Campo de Provincia -->
                <div class="mb-3">
                    <label for="provincia" class="form-label fw-bold">Provincia</label>
                    <input type="text" class="form-control form-control-lg" id="provincia" name="provincia"
                        placeholder="Escribe la provincia" required>
                </div>

                <!-- Campo de Ciudad -->
                <div class="mb-3">
                    <label for="ciudad" class="form-label fw-bold">Ciudad</label>
                    <input type="text" class="form-control form-control-lg" id="ciudad" name="ciudad"
                        placeholder="Escribe la ciudad del campeonato" required>
                </div>

                <!-- Campo de Fecha -->
                <div class="mb-3">
                    <label for="fecha" class="form-label fw-bold">Fecha</label>
                    <input type="date" class="form-control form-control-lg" id="fecha" name="fecha"
                        required>
                </div>

                <!-- Campo de Registro -->
                <div class="mb-3">
                    <label for="estado" class="form-label fw-bold">Registro</label>
                    <select class="form-select form-select-lg" id="registro" name="registro" required>
                        <option value="0">Abierto</option>
                        <option value="1">Cerrado</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" name="guardarCambios" class="btn btn-primary">Añadir Campeonato</button>
                </div>
            </form>

        </div>
    </div>
</div>