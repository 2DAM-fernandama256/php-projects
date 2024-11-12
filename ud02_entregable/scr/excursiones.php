<?php
session_start();

// Verificación de inicio de sesión
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
    <title>Galería de Imágenes</title>
    <!-- si no le cambio esto no se ven las flechitas del carrusel-->
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }
    </style>
</head>

<body>

    <div class="container text-center mb-4">
        <div class="d-flex justify-content-center align-items-center bg-custom py-3">
            <img src="img/martinez.png" class="rounded-circle me-3" width="50" height="50" alt="Foto de perfil">
            <h1 class="mb-0">Galería</h1>
        </div>
    </div>

    <?php
    $pagina = "excursiones";
    require 'includes/header.php';
    ?>
    <h1 class="text-center mb-4 p-4">Excursiones</h1>
    <?php
    // Carpeta de imágenes
    $directorio = 'carrusel/';

    // Manejo de carga de imágenes
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
        $archivo = basename($_FILES['archivo']['name']);
        $targetFilePath = $directorio . $archivo;

        // Verificación de tipo de archivo
        $extension = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $targetFilePath)) {
                $mensaje = "Imagen subida exitosamente.";
            } else {
                $mensaje = "Error al subir la imagen.";
            }
        } else {
            $mensaje = "Por favor, sube un archivo de imagen válido.";
        }
    }
    ?>
    <!--eso es para subir la imagen que tu quieras -->
    <div class="container mb-4">
        <form action="" method="post" enctype="multipart/form-data" class="d-flex">
            <input type="file" name="archivo" class="form-control w-50" required>

            <button type="submit" class="btn btn-primary ms-2 ">Subir Imagen</button>
        </form>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info mt-2"><?php echo $mensaje; ?></div>
        <?php endif; ?>
    </div>

    <div class="container text-center">
        <div id="carrusel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                // Obtener todas las imágenes de la carpeta
                $imagenes = glob($directorio . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                foreach ($imagenes as $index => $imagen):
                    ?>
                    <button type="button" data-bs-target="#carrusel" data-bs-slide-to="<?php echo $index; ?>"
                        class="<?php echo $index === 0 ? 'active' : ''; ?>"
                        aria-label="Slide <?php echo $index + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
                <!--mostrar imagenes de la carpeta-->
            <div class="carousel-inner">
                <?php foreach ($imagenes as $index => $imagen): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $imagen; ?>" class="rounded mx-auto d-block" style="width: 50%; height: auto;"
                            alt="Imagen <?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
    </div>

</body>

</html>