<?php

$nota = rand(1, 10);

if ($nota >= 0 && $nota <= 5) {
    $calificacion = "Insuficiente";
} elseif ($nota >= 5 && $nota < 6) {
    $calificacion = "Suficiente";
} elseif ($nota >= 6 && $nota < 7) {
    $calificacion = "Bien";
} elseif ($nota >= 7 && $nota < 9) {
    $calificacion = "Notable";
} elseif ($nota >= 9 && $nota <= 10) {
    $calificacion = "Sobresaliente";
}

echo "La nota obtenida es: $nota<br>";
echo "La calificación es: $calificacion";
?>
