<?php
session_start();

// Verificación de sesión
if (!isset($_SESSION['login'])) {
    header('Location: ./login.php');
    exit;
}
?>

<?php
    $pagina = "galeria";
    require './includes/header.php';
    ?>

<body>
    <br>
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
                <div class="row">
                <?php foreach ($imagenes as $index => $imagen): ?>

                    <div class="card col3" style="width: 18rem;">
                        <img src="<?php echo $imagen; ?>" class="card-img-top" alt="<?php echo $imagen; ?>">
                    <div class="card-body">
                        <form action="galeria.php" method="post">
                        <button type="button" class="btn btn-danger" name="eliminar">eliminar</button>
                        <?php if(isset($_POST['eliminar'])) {
                            if(unlink($imagen)) {
                                echo "eliminada";
                            } else{echo "no";}
                         }?>
                        </form>
                     </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>