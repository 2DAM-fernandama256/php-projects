<?php

require './includes/data.php';

require './includes/header.php';

// titulo, autor, id_categoria, disponible, imagen
$sql = "SELECT titulo, autor, id_categoria, disponible, imagen From libros";
$resultado = mysqli_query($conn,$sql);

?>
<div class="container">
    <div class="row m-4 justify-content-between">
        <!-- Botón para ver reservas si está logueado -->

        <div class="col-4 mb-4">

        </div>

        <!--FILTRO POR CATEGORÍA-->
        <form class="col-8">

        </form>
    </div>
    <?php
    if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo '<div class="row">';
    while ($libro = mysqli_fetch_assoc($resultado)) {
        ?>
        <div class="col-md-4 d-flex align-items-stretch pb-1">
            <div class="card shadow">
                <img src="./img/<?php echo htmlspecialchars($libro['imagen']); ?>" class="img-thumbnail w-50" alt="<?php echo htmlspecialchars($libro['titulo']); ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                    <p class="card-text">
                        <strong>Autor:</strong> <?php echo htmlspecialchars($libro['autor']); ?><br>
                        <strong>Categoría:</strong> <?php echo htmlspecialchars($libro['id_categoria']); ?>
                    </p>
                    <div class="mt-auto">
                        <?php if ($libro['disponible'] == 1): ?>
                            <button class="btn btn-primary w-100">Reservar</button>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>No disponible</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
} else {
    echo '<p>No hay libros disponibles.</p>';
}
?>
</div>

<!-- Modal para mostrar reservas -->

<div class="modal fade" id="reservasModal" tabindex="-1" aria-labelledby="reservasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se pueden listar las reservas del usuario -->
                <p>Aquí se mostrarán las reservas del usuario logueado.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>