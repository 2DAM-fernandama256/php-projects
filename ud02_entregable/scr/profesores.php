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
    <title>Gestión de Profesores</title>
</head>
<body>

<div class="container text-center mb-4">
    <div class="d-flex justify-content-center align-items-center bg-custom py-3">
        <img src="img/martinez.png" class="rounded-circle me-3" width="50" height="50" alt="Foto de perfil">
        <h1 class="mb-0">Gestion de profesores</h1>
    </div>
</div>

    <?php
    $pagina = "profesores";
    require 'includes/header.php';
    ?>

    <div class="container p-4">
        <h2 class="text-center justify-content-center">Profesorado</h2>

        <!-- Botones de ordenación -->
        <form action="profesores.php" method="POST" class="mb-4">
            <button type="submit" name="orden" class="btn btn-success" value="asc">Ordenar A-Z</button>
            <button type="submit" name="orden" class="btn btn-danger" value="desc">Ordenar Z-A</button>
        </form>

        <?php
        // Datos de los profesores
        $profesores = [
            ["nombre" => "Alejandro", "correo" => "Alejandro@gmail.com", "curso" => "1 DAM"],
            ["nombre" => "chema", "correo" => "chema@gmail.com", "curso" => "2 DAM"],
            ["nombre" => "maria", "correo" => "maria@gmail.com", "curso" => "1 DAM"],
            ["nombre" => "jose", "correo" => "jose@gmail.com", "curso" => "2 DAM"]
        ];

        // Ordenar profesores si se ha enviado el formulario
        if (isset($_POST['orden'])) {
            usort($profesores, function ($a, $b) {
                $orden = $_POST['orden'] === 'asc' ? 1 : -1;
                return $orden * strcmp($a['nombre'], $b['nombre']);
            });
        }
        ?>

    </div>

    <div class="container">
        <div class="row col-sm-12 p-4">
            <?php foreach ($profesores as $prof): ?>
                <div class="col-12 col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header"><?= htmlspecialchars($prof["curso"]) ?></h5>
                            <p class="card-title"><?= htmlspecialchars($prof["nombre"]) ?></p>
                            <p class="card-text"><?= htmlspecialchars($prof["correo"]) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>

