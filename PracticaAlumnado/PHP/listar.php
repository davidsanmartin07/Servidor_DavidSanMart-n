<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnado</title>
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>

<?php
// --- Conexión a la base de datos ---
$host     = "127.0.0.1";
$usuario  = "root";
$password = ""; // pon aquí tu contraseña de MySQL si tienes una
$bd       = "php";

$conexion = mysqli_connect($host, $usuario, $password, $bd);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8mb4");

echo "<h2>Listado de alumnado</h2>";

$sql = "SELECT nombre, apellidos, fecha_nacimiento, curso, email
        FROM alumnos
        ORDER BY apellidos, curso";
$resultado = mysqli_query($conexion, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo "<table class='tabla-alumnado'>";
    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Curso</th><th>Email</th></tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['fecha_nacimiento']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['curso']) . "º ESO</td>";
        echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Todavía no hay alumnado matriculado.</p>";
}

echo '<p class="volver"><a href="../index.html">&larr; Volver al formulario</a></p>';

mysqli_close($conexion);
?>

</body>
</html>