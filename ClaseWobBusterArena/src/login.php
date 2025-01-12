<?php
    session_start();

    require './includes/data.php';

    $_SESSION["rol"] = "nologued";
    $notFound = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (!isset($_POST["logout"]) && isset($_POST["username"]) && isset($_POST["password"])) {
            $array_usuarios = getUsuarios($db);

            $username = $_POST["username"];
            $password = $_POST["password"];
            
            foreach ($array_usuarios as $user) {
                // Verificar credenciales
                if ($username == $user["nombre"] && password_verify($password, $user["password"])) {
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    $_SESSION['id_usuario'] = $user["id_usuario"];
                    $_SESSION["rol"] = $user["rol"]; 
                    $notFound = true;

                    // Redirigir a la página de alumnos matriculados
                    header("Location: index.php");
                    exit();
                }
            }        
        }
        elseif (isset($_POST["logout"])) {

            $username = "";
            $password = "";

            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            session_destroy();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    
    <!-- Formulario para el LOGIN -->
    <div class="container-fluid">        
        <div class="row vh-100 justify-content-center align-items-center pb-5">
            <div class="col-8 col-sm-8 col-md-4 p-10">
                <h2 class="d-flex mb-4 alig-items-center justify-content-center">Iniciar Sesión</h2> 
                <div class="card p-4 style='width: 20rem;'">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombre de Usuario</label>
                            <input type="text" name="username" class="form-control" placeholder="Introduce tu nombre de usuario">
                        </div>
                        <div class="mb-3">
                            <label for="pswd" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Introduce tu contraseña">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                        <!-- Se le da opción a entrar como Invitado directamente   
                        <div class="d-grid mt-3">
                            <a href="./index.php" class="btn btn-danger">Continuar como Invitado</a>
                        </div> -->
                        <?php if ($notFound): ?> <!-- Mensaje de error en el Login --> 
                            <div class="alert alert-danger mt-4 mb-1" role="alert">
                                <?= "Usuario o contraseña incorrectos"; ?>   
                            </div>                     
                        <?php endif; ?>                        
                    </form>
                </div>
            </div>            
        </div>
    </div>

</body>
</html>
