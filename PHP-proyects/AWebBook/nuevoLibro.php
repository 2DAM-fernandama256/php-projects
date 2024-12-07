<?php

require './includes/header.php';
require './includes/data.php'; 


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php");
    exit();
}

$error = "";
$success = "";

// creacion de libro
if (isset($_POST['registrar_libro'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $id_categoria = $_POST['id_categoria'];
    $imagen = $_FILES['imagen']['name'];

    if (empty($titulo) || empty($autor) || empty($id_categoria) || empty($imagen)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $target_dir = "img/";
        $target_file = $target_dir . basename($imagen);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO libros (titulo, autor, id_categoria, imagen, disponible) 
                    VALUES ('$titulo', '$autor', '$id_categoria', '$imagen', 1)";
            if (mysqli_query($conn, $sql)) {
                $success = "Libro registrado con éxito.";
                header("Location: index.php");
            } else {
                $error = "Error al registrar el libro: " . mysqli_error($conn);
            }
        } else {
            $error = "Hubo un problema al subir la imagen.";
        }
    }
}

// categorias 
$sql_categorias = "SELECT id_categoria, nombre FROM categorias";
$resultado_categorias = mysqli_query($conn, $sql_categorias);

?>

<div class="container mt-4">
    <h2>Registrar Nuevo Libro</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <!-- formulario de libro -->
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
        </div>
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-select" id="id_categoria" name="id_categoria" required>
                <option value="">Seleccionar categoría</option>
                <?php while ($categoria = mysqli_fetch_assoc($resultado_categorias)): ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <button type="submit" name="registrar_libro" class="btn btn-primary">Registrar Libro</button>
    </form>
</div>