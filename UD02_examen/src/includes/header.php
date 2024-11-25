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
<div class="container text-center mb-4">
    <div class="d-flex justify-content-center align-items-center bg-custom py-3">
        <img src="img/logo_eventos.png" class="rounded-circle me-3" width="50" height="50" alt="Foto de perfil">
        <h1 class="mb-0">PlanificaT</h1>
        <br>
    </div>
</div>

  <div class="container text-center">
    <div class="row align-items-start" >
    <ul class="nav nav-pills">
      <div class="col">
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "eventos" ? "active" : "" ?>" aria-current="page" href="eventos.php">eventos</a>
      </li>
      </div>
      <div class="col">
      <li class="nav-item">
        <a class="nav-link <?= $pagina == "galeria" ? "active" : "" ?>" href="galeria.php">Galeria</a>
      </li>
      </div>
    </ul>
    </div>
  </div>
</body>

</html>