<?php
require './includes/data.php';
require './includes/header.php';

$competiciones = ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['filtrado'])) ?
            getcompeticiones($db, $_GET['categoriaEscogida'])
            :
            getcompeticiones($db, null);


            if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['reservar'])) {
                if (!isset($_SESSION['username'])) {
                    header("Location: login.php");
                    exit();
                } else {
                    $_SESSION['id_reserva'] = $_GET['id_campeonato'];
                    header("Location: reserva.php");
                    exit();
                }
            } else if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['eliminar'])) {
                eliminarCampeonato($db, $_GET['id_campeonato']);
                header("Location: index.php");
                exit();
            }


            if (isset($_SESSION['username'])) {
                if ($_SESSION['is_admin'] == "Atleta")
                    $reservasUsuarioActual = getReservas($db, $_SESSION['username']);
                else if ($_SESSION['is_admin'] == "Administrador")
                    $reservasUsuarioActual = getReservas($db);
            }


            $insercionCorrecta = false;
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registrar'])) {
                if (!empty($_POST['provincia']) && !empty($_POST['disponibilidad'])) {
                    $directorio = './img/';
            
                    if (isset($_FILES['subidaCaratula'])) {
                        $archivoImagen = $directorio . basename($_FILES['subidaCaratula']['name']);
                        if (pathinfo($archivoImagen, PATHINFO_EXTENSION) == "png" || pathinfo($archivoImagen, PATHINFO_EXTENSION) == "jpg" || pathinfo($archivoImagen, PATHINFO_EXTENSION) == "jpeg") 
                            move_uploaded_file($_FILES['subidaCaratula']['tmp_name'], $archivoImagen);
                    }
                
                    $insercionCorrecta = insertarCompe($db,
                    $_POST['nombre'], $_POST['fecha'], 
                    $_POST['ciudad'], $_POST['provincia'],$_POST['precio'], $_POST['cerrado'],basename($_FILES['subidaCaratula']['name'])
                    );
                
                    header('Location: index.php');
                }
            }

 
?>


<div class="container">
    <div class="row m-4 justify-content-between">
        <?php
          
            if (isset($_GET['id_campeonato'])) {
                if ($insercionCorrecta)
                    echo "<div class='alert alert-success mt-4 text-center' role='alert'>Inserción de competicion correcta</div>";
                else if (!$insercionCorrecta)
                    echo "<div class='alert alert-danger mt-4 text-center' role='alert'>Inserción de competicion incorrecta</div>";
            }
        ?>
        <div class="col-4">
            <form>
            <?php
                if (isset($_SESSION['username']) && $_SESSION['is_admin'] == "administrador") {
                    echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#registrarcompeticion'>
                    Registrar competicion
                    </button>";
                    echo "<button type='button' class='btn btn-primary ms-3' data-bs-toggle='modal' data-bs-target='#mostrarListadoReservas'>
                    Listado de reservas
                    </button>";
                } else if (isset($_SESSION['username']) && $_SESSION['is_admin'] == "atleta")
                    echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#reservasPersonales'>
                    Mis reservas
                    </button>";
            ?>
            </form>
        </div>

        <form class="col-8 d-flex" method="GET">

        <select class="form-select w-75" name="categoriaEscogida">
                <option value="" selected>filtrar por...</option>
                <option value="0">registro cerrado</option>
                <option value="1">registro abierto</option>
            </select>
            <select class="form-select w-75" name="categoriaEscogida">
                <option value="" selected>provincia</option>
                <option value="Granada">Granada</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Cadiz">Cadiz</option>
                <option value="Madrid">Madrid</option>
            </select>
            <input type="submit" class='btn btn-success active' name="filtrado" value="Filtrar">
            <input type="submit" class='btn btn-danger active' value="Limpiar">
        </form>
    </div>


    <div class="row">
       
        <?php foreach ($competiciones as $c): ?>
            <div class="col-md-4 d-flex align-items-stretch pb-1">
                <div class="card shadow">
                    <?php
                        $nombreImagen = $c['imagen'];
                        echo "<img src='./img/$nombreImagen' class='img-thumbnail w-50' alt=''>";
                    ?>
                    <div class="card-body d-flex flex-column">
                        <form method="GET">
                            <h5 class="card-title"><?= $c['nombre']; ?></h5>
                            <p class="card-text">
                                <strong>fecha:</strong> <?= $c['fecha']; ?><br>
                                <strong>lugar:</strong> <?= $c['provincia']; ?><br>
                                <strong>Precio:</strong> <?= $c['precio']; ?>
                            </p>
                            <div class="mt-auto">
                                <?php

                                    if ($c['cerrado'] == 1) {
                                        if (isset($_SESSION['username'])) {
                                            if ($_SESSION['rol'] == "Administrador") 
                                                echo "<input type='submit' name='eliminar' class='btn btn-primary w-100 active' value='Eliminar'>";
                                            else
                                                echo "<input type='submit' name='inscrivirse' class='btn btn-primary w-100 disabled' >
                                            <input type='submit' name='abierta' class='btn btn-secundary w-100 active' >";
                                        } else 
                                            echo "<input type='submit' name='reservar' class='btn btn-primary w-100 active value='Reservar'>
                                            <input type='submit' name='abierta' class='btn btn-secundary w-100 disabled' >";
                                        echo "<input type='hidden' name='id_campeonato' value='".$c['id_campeonato']."' />";
                                    } else
                                        echo "<button class='btn btn-secondary w-100 disabled'>inscribirse</button>
                                        <button class='btn btn-secondary w-100 disabled'>cerrada</button>";
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <div class="modal fade" id="reservasPersonales" tabindex="-1" aria-labelledby="reservasPersonalesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">nombre competicion</th>
                            <th scope="col">Fecha de competicion</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($reservasUsuarioActual as $reserva): ?>
                            <tr>
                                <th scope="row"><?=$reserva['id_libro']?></th>
                                <td><?=$reserva['titulo']?></td>
                                <td><?=$reserva['fecha_c']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="registrarCampeonatos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Registrar Campeonato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nombre" placeholder="nombre" aria-label="Nombre competicion" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fecha" placeholder="fecha" aria-label="fecha" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="ciudad" placeholder="ciudad" aria-label="ciudad" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">provincias</span>
                        <select class="form-select" name="categoria" aria-label="Selector categoría" required>
                            <option value="" selected>Seleccione la provincia</option>
                            <option value="1">Sevilla</option>
                            <option value="2">Cadiz</option>
                            <option value="3">Granada</option>
                            <option value="4">Madrid</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="precio" placeholder="precio" aria-label="precio" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Disponibilidad del campeonato</span>
                        <select class="form-select" name="disponibilidad" aria-label="Selector disponibilidad" required>
                            <option value="" selected>Seleccione la disponiblidad</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 justify-content-center">
                        <input name="subidaCaratula" type="file" required>
                    </div>
                    <div class="input-group justify-content-center">
                        <input type='submit' name='registrar' value="Registrar competicion" class='btn btn-primary w-25 active'>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mostrarListadoReservas" tabindex="-1" aria-labelledby="mostrarListadoReservasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Listado de Reservas Global</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Nombre competicion</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($reservasUsuarioActual as $reserva): ?>
                            <tr>
                                <td><?=$reserva['usuario']?></td>
                                <td><?=$reserva['email']?></td>
                                <td><?=$reserva['titulo']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



</div>
