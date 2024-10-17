<?php
$pagina ="proyectos";

$proyectos =["Desarrollo de aplicaciones indetex ", "Migracion de base de datos", "acceso a datos"
]
?>
<ul class="list-group">
  
<?php
foreach ($proyectos as $p) {
    echo "<li class='list-group-item'>An $p</li>";
}
?>
</ul>
