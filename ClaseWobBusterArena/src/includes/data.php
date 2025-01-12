<?php
    require 'conexion.php';

    function getCompeticiones($db, $id_campeonato = null, $general = null, $provincia = null, $id_user = null) {

        $sql = "";

        // Para Editar
        if ($id_campeonato != null) {
            $sql = "SELECT * FROM campeonatos 
                    WHERE id_campeonato = $id_campeonato"; 
        }
        // Filtro cuando viene el tipo de registro y la provincia
        elseif (($general == "cerrado" || $general == "abierto") && $provincia != null) {
            $campoCerrado = $general == "cerrado" ? 1 : 0;
            $sql = "SELECT * FROM campeonatos 
                    WHERE cerrado = $campoCerrado AND provincia = '$provincia';";
        }
        // Filtro cuando viene el tipo de registro y no la provincia
        elseif (($general == "cerrado" || $general == "abierto") && $provincia == null) {
            $campoCerrado = $general == "cerrado" ? 1 : 0;
            $sql = "SELECT * FROM campeonatos 
                    WHERE cerrado = $campoCerrado;";
        }
        // Filtro cuando viene mis competiciones y la provincia
        elseif ($general == "misComp"  && $provincia != null) {
            $sql = "SELECT * FROM campeonatos c
                    INNER JOIN inscripciones i ON c.id_campeonato = i.id_campeonato 
                    WHERE i.id_usuario = $id_user AND c.provincia = '$provincia';";
        }
        // Filtro cuando viene solo mis competiciones
        elseif ($general == "misComp"  && $provincia == null) {
            $sql = "SELECT * FROM campeonatos c
                    INNER JOIN inscripciones i ON c.id_campeonato = i.id_campeonato 
                    WHERE i.id_usuario = $id_user;";
        }
        else {
            $sql = "SELECT * FROM campeonatos;";
        }

        $comp = mysqli_query($db, $sql);
        $resultado = array();

        if ($comp && mysqli_num_rows($comp) >= 1) {
            while ($c = mysqli_fetch_assoc($comp)) {
                array_push($resultado, $c);
            }
        }
        
        return $resultado;
    }

    function getUsuarios($db) {

        $sql = "SELECT * FROM usuarios;";
        $usuarios = mysqli_query($db, $sql);
        $resultado = array();

        if ($usuarios) {
            while ($u = mysqli_fetch_assoc($usuarios)) {
                array_push($resultado, $u);
            }
        }
        
        return $resultado;
    }

    function getInscripciones($db, $id_user) {

        $sql = "SELECT * FROM inscripciones WHERE id_usuario = $id_user;";
        $inscripciones = mysqli_query($db, $sql);
        $resultado = array();

        if ($inscripciones && mysqli_num_rows($inscripciones) >= 1) {
            while ($i = mysqli_fetch_assoc($inscripciones)) {
                array_push($resultado, $i);
            }
        }
        
        return $resultado;
    }

    function getProvincias($db) {

        $sql = "SELECT DISTINCT provincia FROM campeonatos;";
        $provincia = mysqli_query($db, $sql);
        $resultado = array();

        if ($provincia && mysqli_num_rows($provincia) >= 1) {
            while ($p = mysqli_fetch_assoc($provincia)) {
                array_push($resultado, $p);
            }
        }
        
        return $resultado;
    }

    function guardarCambiosCampeonato($db, $id_campeonato, $nombre,  $ciudad,  $provincia, $fecha, $registro){
        $check = false;

        $sqlUpdate = "UPDATE campeonatos SET
        nombre = '$nombre',
        fecha = '$fecha',
        provincia = '$provincia',
        ciudad = '$ciudad',
        cerrado = $registro
        WHERE id_campeonato = $id_campeonato;";

        $query = mysqli_query($db, $sqlUpdate);

        if ($query) {
            $check = true;
        }

        return $check;
    }

    function eliminarCampeonato($db, $id_campeonato){
        $check = false;

        $sqlInscripcion = "DELETE FROM inscripciones 
                           WHERE id_campeonato = $id_campeonato;";
        $query1 = mysqli_query($db, $sqlInscripcion);

        $sqlDelete = "DELETE FROM campeonatos WHERE id_campeonato = $id_campeonato;";
        $query2 = mysqli_query($db, $sqlDelete);

        if ($query1 && $query2) {
            $check = true;
        }

        return $check;
    }

    function addCampeonato($db, $nombre, $ciudad, $provincia, $fecha, $registro)
    {
        $check = false;

        $sqlInsert = "INSERT INTO campeonatos (nombre, fecha, ciudad, provincia, cerrado) 
        VALUES ('$nombre', '$fecha', '$ciudad', '$provincia', $registro);";

        $query = mysqli_query($db, $sqlInsert);

        if ($query) {
            $check = true;
        }

        return $check;
    }

    function deleteInscripcion($db, $id_inscri) {
        $check = false;

        $sqlInscripcion = "DELETE FROM inscripciones 
                           WHERE id_inscripcion = $id_inscri;";
        $query = mysqli_query($db, $sqlInscripcion);

        if ($query) {
            $check = true;
        }

        return $check;
    }

    function addInscripcion($db, $id_user, $id_campeonato) {
        $check = false;

        $sqlInsert = "INSERT INTO inscripciones (id_usuario, id_campeonato)
        VALUES ($id_user, $id_campeonato);";

        $query = mysqli_query($db, $sqlInsert);

        if ($query) {
            $check = true;
        }

        return $check;
    }
   
?>