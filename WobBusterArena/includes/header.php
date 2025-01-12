<!DOCTYPE html>
<html lang="en">

<?php


session_start();
if (!isset($_SESSION['username']))
    $_SESSION = [];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['logout'])) {
        $_SESSION = [];
        header("Location: index.php");
    } else if (isset($_POST['login'])) {
        header("Location: login.php");
        exit();
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Campeonatos</title>
    <style>
        header {
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="bg-warning-subtle">
        <form class="d-flex justify-content-end p-2" method="POST">
            <input type="submit" class="btn btn-dark"
                name="<?= isset($_SESSION['username']) ? "logout" : "login" ?>"
                value="<?= isset($_SESSION['username']) ? "Cerrar sesión" : "Iniciar Sesión" ?>">
        </form>
        <header class="cabecera d-flex align-items-center justify-content-center p-4">
            <img src="./img/logo_app.png" class="img-fluid logo me-2" alt="Logo IES">
        </header>
    </div>