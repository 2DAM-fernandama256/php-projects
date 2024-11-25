<?php

require './includes/data.php';
require './includes/header.php';
$tareas_doing = [];
$tareas_toDo = [];
$tareas_done = [];

$resultado_tareas = getTareas($bd);

foreach ($resultado_tareas as $tarea) {
    if ($tarea['estado'] == 'done') {
        // $tareas_done[] = $tarea;
        array_push($tareas_done, $tarea);
    } else if ($tarea['estado'] == 'doing') {
        // $tareas_doing[] = $tarea;
        array_push($tareas_doing, $tarea);
    } else {
        // $tareas_toDo[] = $tarea;
        array_push($tareas_toDo, $tarea);
    }
}

?>

<div class="container my-5">
    <div class="row">
        <!-- Columna de tareas to_do -->
        <div class="col-md-4">
            <h2 class="text-center bg-danger text-dark p-2 rounded">TO DO</h2>
            <div class="card-columns">
                <php foreach(tareas_done as tarea): />
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <li class="list-group-item"></li>
                        <li class="list-group-item"></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Columna de tareas doing -->
        <div class="col-md-4">
            <h2 class="text-center bg-warning text-dark p-2 rounded">DOING</h2>
            <div class="card-columns">

            </div>
        </div>

        <!-- Columna de tareas done -->
        <div class="col-md-4">
            <h2 class="text-center bg-success text-white p-2 rounded">DONE</h2>
            <div class="card-columns">

            </div>
        </div>
    </div>
</div>