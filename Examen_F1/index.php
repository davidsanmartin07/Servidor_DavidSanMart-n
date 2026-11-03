<?php
// Al requerir FAcademy se cargan en cascada el resto de clases (F4, F3, F2, F1, Monoplaza)
require_once 'FAcademy.php';

// --- 1. Cadena de ascensos ---
$piloto = new FAcademy("Marta García", "ESP", 15, "Prema Racing", 0, 165);
echo "Categoría inicial: <b>" . get_class($piloto) . "</b><br>";

$piloto = $piloto->subirCategoria("España");
echo "Ascenso 1: <b>" . get_class($piloto) . "</b><br>";

$piloto = $piloto->subirCategoria("Ferrari Driver Academy");
echo "Ascenso 2: <b>" . get_class($piloto) . "</b><br>";

$piloto = $piloto->subirCategoria(true);
echo "Ascenso 3: <b>" . get_class($piloto) . "</b><br>";

$piloto = $piloto->subirCategoria("Santander");
echo "<h3>Categoría final: <b>" . get_class($piloto) . "</b></h3>";

echo "<pre>";
print_r($piloto);
echo "</pre>";

// --- 2. Pruebas de otorgarPuntos() ---
echo "<h3>Pruebas de puntos</h3>";

// Cada carrera es [posición, puntos por posición, puntos por vuelta rápida] (calculados a mano).
// Todas las carreras se hacen con vuelta rápida.
function mostrarPrueba(string $nombre, Monoplaza $piloto, array $carreras): void {
    $sinVR = 0;
    $extraVR = 0;

    echo "<b>$nombre</b> (todas con vuelta rápida)<br>";
    foreach ($carreras as [$posicion, $puntosPosicion, $puntosVR]) {
        $piloto->otorgarPuntos($posicion, true);
        $sinVR += $puntosPosicion;
        $extraVR += $puntosVR;
        echo "Posición $posicion: $puntosPosicion por posición, $puntosVR por vuelta rápida<br>";
    }

    echo "Puntos por posición (sin vuelta rápida): $sinVR<br>";
    echo "Puntos por vuelta rápida: $extraVR<br>";
    echo "Total esperado: " . ($sinVR + $extraVR) . "<br>";
    echo "Puntos obtenidos: " . $piloto->getPuntos() . "<br><br>";
}

// F1: la posición 15 no puntúa ni está en el top 10; la 23 no es válida (solo hay 22 pilotos)
$f1 = new F1("Piloto F1", "ESP", 1, "Escudería", 0, "Santander");
mostrarPrueba("F1", $f1, [[1, 25, 1], [10, 1, 1], [15, 0, 0], [23, 0, 0]]);

// F2: el 10º no puntúa en la tabla, pero con vuelta rápida en el top 10 suma 1
$f2 = new F2("Piloto F2", "ESP", 2, "Escudería", 0, false);
mostrarPrueba("F2", $f2, [[10, 0, 1]]);

// F3: no da puntos por vuelta rápida
$f3 = new F3("Piloto F3", "ESP", 3, "Escudería", 0, "Academia");
mostrarPrueba("F3", $f3, [[1, 10, 0]]);

// F4: no da puntos por vuelta rápida
$f4 = new F4("Piloto F4", "ESP", 4, "Escudería", 0, "España");
mostrarPrueba("F4", $f4, [[1, 25, 0]]);

// FAcademy
$fa = new FAcademy("Piloto FA", "ESP", 5, "Escudería", 0, 165);
mostrarPrueba("FAcademy", $fa, [[1, 18, 1]]);