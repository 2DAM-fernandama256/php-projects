<?php

require './includes/data.php';
require './includes/header.php';

$comres = getcompeticiones($db, null);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['reservar'])) {
    if (!empty($_GET['fechaReserva'])) {
        reservarcompe($db, $_SESSION['nombre'], $_SESSION['id_competicion']);

        unset($_SESSION['id_inscripcion']);
        header("Location: index.php");
        exit(); 
    }
} 

?>

<div class="container">
    <h2 class="my-4 text-center">competicon a reservar</h2>
    <div class="row my-4 justify-content-center">
        <div class="card shadow w-25">
            <?php foreach ($comres as $com) : ?>
                <?php if ($com['id_campeonato'] == $_SESSION['id_campeonato']) : ?>
                    <div class="my-2 d-flex align-items-stretch pb-1">
                        <div class="card shadow">
                            <?php
                                $nombreImagen = $com['imagen'];
                                echo "<img src='./img/$nombreImagen' class='img-thumbnail w-50' alt=''>";
                            ?>
                            <div class="card-body d-flex flex-column">
                                <form method="GET">
                                    <span name="id_campeonato" value="<?=$com['id_campeonato']?>" aria-hidden=true></span>
                                    <h5 class="card-title"><?= $com['nombre']; ?></h5>
                                    <p class="card-text">
                                        <strong>fecha:</strong> <?= $com['fecha']; ?><br>
                                        <strong>ciudad:</strong> <?= $com['ciudad']; ?>
                                        <strong>provincia:</strong> <?= $com['provincia']; ?>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>