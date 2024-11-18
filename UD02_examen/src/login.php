<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];
    $contrasena2 = $_POST["password2"];
    // Usuario y contraseña predeterminados
    $usuario_valido = "fernando";
    $contrasena_valida = "famajim030";
    $segundaContra_valida="famajim030";

    if ($usuario != $usuario_valido || $contrasena != $contrasena_valida || $contrasena2 != $segundaContra_valida ) {
        $mensaje_error = "Usuario o contraseña incorrectos";
    } else {
        $_SESSION['login'] = true;
        header('Location: ./eventos.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container bg-white rounded shadow p-4">
        <h2 class="text-center mb-4">Login</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">repite la contraseña</label>
                <input type="password" class="form-control" id="password" name="password2" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      <!--alerta si esta incorrecto-->
        <?php if (isset($mensaje_error)): ?>
            <div class="alert alert-danger mt-4 text-center" role="alert"><?= $mensaje_error ?></div>
        <?php endif; ?>
    </div>
</body>

</html>