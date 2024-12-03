<?php
require 'conexion.php';
function getTareas($bd , $id_user= null) 
{
    $sql = $id_user!=null? "SELECT id, descripcion, fecha_entrega, estado FROM tareas t where t.usuario_id = '$id_user'"
    :"SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t;";
    
    $tareas = mysqli_query($bd, $sql);

    $resultado = array();

    if($tareas && mysqli_num_rows($tareas) > 0){
        while($tarea = mysqli_fetch_assoc($tareas)){
            array_push($resultado, $tarea);
        }
    }

    return $resultado; 
}


function guardarNuevoUsuario($nombre, $email, $password, $bd){
    //CIFRAR CONTRASEÑA
    //Cost=>4, cifra 4 veces la contraseña
    $password_segura=password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    //Comprobamos que la contraseña dada por el usuario corresponde con la cifrada.
    password_verify($password, $password_segura); //Lo usamos para hacer el login.

    $sqlInsert= "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password_segura')";

    $query = mysqli_query($bd, $sqlInsert);

    if($query){
        $_SESSION['registro'] = true;
    }else{
        $_SESSION['registro']=false;
    }

    return $_SESSION['registro'];
}

function getUsers($bd){
    $sql = "SELECT id, nombre, email, contraseña FROM usuarios;";
    $usuarios = mysqli_query($bd, $sql);

    $resultado = array();
    if($usuarios && mysqli_num_rows($usuarios) >= 1){
        while ($user = mysqli_fetch_assoc($usuarios)) {
            array_push($resultado, $user);
        }
    }
    return $resultado;
}


function insertarTarea($bd, $titulo, $descripcion, $fecha_entrega, $estado, $id_user)
{
	$check = false;

    $sqlInsert = " INSERT INTO tareas ( usuario_id, titulo, descripcion, fecha_entrega, estado)
    VALUES ( $id_user, '$titulo', '$descripcion', '$fecha_entrega', '$estado')";

    $query = mysqli_query($bd, $sqlInsert);
    if ($query){
        $check = true;
    }
    return $check;
}

function guardarCambiosTarea($bd, $id_tarea, $titulo, $descripcion, $fecha_entrega, $estado, $id_user) {
    $check = false;

    // Construcción de la consulta SQL
    $sqlInsert = "
        UPDATE tareas 
        SET 
            titulo = '$titulo',
            descripcion = '$descripcion',
            fecha_entrega = '$fecha_entrega',
            estado = '$estado'
        WHERE 
            id = $id_tarea AND 
            usuario_id = $id_user
    ";

    // Ejecución de la consulta
    $query = mysqli_query($bd, $sqlInsert);

    // Verificación de la ejecución
    if ($query) {
        $check = true;
    }

    return $check;
}

function eliminarTarea($bd, $id_tarea){
    $check = false;

    $sqlInsert ="DELETE FROM tareas WHERE id='$id_tarea'";
    $query = mysqli_query($bd, $sqlInsert);

    if($query){
        $check = true; 
    }
    return $check;
}


?>
