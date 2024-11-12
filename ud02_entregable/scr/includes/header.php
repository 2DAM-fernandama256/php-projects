<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<style>
    .bg-custom {
    background-color: #C1E034; /* Cambia el color según tu preferencia */
}
</style>
</head>

<body>


  <div class="d-flex justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "index" ? "active" : "" ?>" aria-current="page" href="index.php">Alumnos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "profesores" ? "active" : "" ?>" href="profesores.php">Profesores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "alta" ? "active" : "" ?>" href="alta.php">Alta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "excursiones" ? "active" : "" ?>" href="excursiones.php">Excursiones</a>
      </li>
    </ul>
  </div>
</body>

</html>