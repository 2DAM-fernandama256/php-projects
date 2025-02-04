<?php
//conexiones 
require './includes/header.php';
require './includes/data.php'; 

// cierre de sesion
if (isset($_POST['logout']) && $_POST['logout'] === 'salir') {
    session_unset();
    session_destroy();
}
//categorias
$sql_categorias = "SELECT id_categoria, nombre FROM categorias";
$resultado_categorias = mysqli_query($conn, $sql_categorias);

$where_clause = "";
if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $id_categoria = intval($_GET['categoria']);
    $where_clause = "WHERE l.id_categoria = $id_categoria";
}
//buscar libros

$sql_libros = "SELECT l.id_libro, l.titulo, l.autor, l.id_categoria, l.disponible, l.imagen, c.nombre AS categoria_nombre 
               FROM libros l 
               LEFT JOIN categorias c ON l.id_categoria = c.id_categoria 
               $where_clause";
$resultado_libros = mysqli_query($conn, $sql_libros);

// obtener reservas de usuario
$contadorTablaReservas = 0;
$reservasUsuarioActual = array();
if (isset($_SESSION['username']) && $_SESSION['username'] != "admin")
    $reservasUsuarioActual = getReservas($conn, $_SESSION['username']);

// manejo reserva libro
if (isset($_POST['reservar']) && isset($_SESSION['id_usuario'])) {
    $id_libro = $_POST['id_libro'];
    $id_usuario = $_SESSION['id_usuario'];

    // mirar si el libro esta disponible antes de la reserva 
    $sql_check_libro = "SELECT disponible FROM libros WHERE id_libro = $id_libro";
    $resultado_libro = mysqli_query($conn, $sql_check_libro);
    $libro = mysqli_fetch_assoc($resultado_libro);

    if ($libro['disponible'] == 1) {
        // hacer reserva
        $sql_reserva = "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva) VALUES ($id_usuario, $id_libro, NOW())";
        if (mysqli_query($conn, $sql_reserva)) {
            // actualizar
            $sql_actualizar_libro = "UPDATE libros SET disponible = 0 WHERE id_libro = $id_libro";
            mysqli_query($conn, $sql_actualizar_libro);

            $sql_reservas = "SELECT r.id_reserva, r.fecha_reserva, l.titulo, l.autor 
                             FROM reservas r
                             INNER JOIN libros l ON r.id_libro = l.id_libro
                             WHERE r.id_usuario = $id_usuario";
            $resultado_reservas = mysqli_query($conn, $sql_reservas);
            if ($resultado_reservas) {
                $reservas = mysqli_fetch_all($resultado_reservas, MYSQLI_ASSOC);
            }
        }
    } else {
        $error_reserva = "El libro no está disponible para reserva.";
    }
}

// eliminar libro
if (isset($_POST['eliminar_libro'])) {
    $id_libro = $_POST['id_libro'];
    $sql_check_reserva = "SELECT COUNT(*) AS reservas_activas FROM reservas WHERE id_libro = $id_libro";
    $resultado_reserva = mysqli_query($conn, $sql_check_reserva);
    $reserva = mysqli_fetch_assoc($resultado_reserva);

    if ($reserva['reservas_activas'] == 0) {
        $sql_eliminar = "DELETE FROM libros WHERE id_libro = $id_libro";
        if (mysqli_query($conn, $sql_eliminar)) {
            // el libro se ha eliminado con exito
            header('Location: index.php'); //recargar pagina 
        }
    } else {
        $error_eliminar = "No se puede eliminar el libro porque está reservado.";
    }
}
?>

<div class="container">

    <div class="row m-4 justify-content-between">
        <div class="col-auto">
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <!--si es admin muestra añadir libro si no muestra mis reservas  -->
                <a href="nuevoLibro.php" class="btn btn-success btn-lg">Añadir Libro</a>
            <?php elseif (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true): ?>
                <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#reservasModal">Mis Reservas</button>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary btn-lg">Mis Reservas</a>
            <?php endif; ?>
        </div>

        <div class="col-auto">
            <form method="GET" action="index.php">
                <div class="d-flex align-items-center">
                    <select class="form-select me-2" name="categoria" aria-label="Seleccionar una categoría">
                        <option value="">Seleccione una categoría</option>
                        <?php
                        while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                            $selected = isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id_categoria'] ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($categoria['id_categoria']) . '" ' . $selected . '>' . htmlspecialchars($categoria['nombre']) . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success me-2">Filtrar</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php';">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- mostrar libros -->
    <div class="row">
        <?php
        while ($libro = mysqli_fetch_assoc($resultado_libros)) { ?>
            <div class="col-md-4 d-flex align-items-stretch pb-1">
                <div class="card shadow">
                    <img src="./img/<?php echo htmlspecialchars($libro['imagen']); ?>" class="img-thumbnail w-50" alt="<?php echo htmlspecialchars($libro['titulo']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                        <p class="card-text">
                            <strong>Autor:</strong> <?php echo htmlspecialchars($libro['autor']); ?><br>
                            <strong>Categoría:</strong> <?php echo htmlspecialchars($libro['categoria_nombre']); ?>
                        </p>
                        <div class="mt-auto">
                            <?php if ($libro['disponible'] == 1): ?>
                                <?php if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true): ?>
                                    <form method="POST" action="reserva.php">
                                        <input type="hidden" name="id_libro" value="<?php echo $libro['id_libro']; ?>">
                                        <button type="submit" name="reservar" class="btn btn-primary w-100">Reservar</button>
                                    </form>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-primary w-100">Iniciar sesión</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>No disponible</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>