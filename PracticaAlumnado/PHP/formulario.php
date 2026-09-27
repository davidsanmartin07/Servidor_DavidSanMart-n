<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
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

if (isset($_POST['nombre'])) {

    // Recogemos los datos del formulario
    $nombre           = $_POST['nombre'];
    $apellidos        = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $curso            = $_POST['curso'];
    $email            = $_POST['email'];
    $contrasena       = $_POST['contrasena'];

    // La contraseña nunca se guarda en texto plano
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // --- Comprobamos que el curso no tenga ya 25 alumnos/as ---
    // Contamos cuántos alumnos hay matriculados en ese mismo curso
    $sql_contar = "SELECT COUNT(*) AS total FROM alumnos WHERE curso = '$curso'";
    $resultado_contar = mysqli_query($conexion, $sql_contar);
    $fila_contar = mysqli_fetch_assoc($resultado_contar);
    $total_en_curso = $fila_contar['total'];

    if ($total_en_curso >= 25) {

        // Si ya hay 25 o más, no dejamos matricular
        echo "<h2>No se puede matricular</h2>";
        echo "<p>El curso seleccionado ya tiene 25 alumnos/as matriculados/as.</p>";

    } else {

        // Si hay sitio, insertamos en la base de datos
        $sql = "INSERT INTO alumnos (nombre, apellidos, fecha_nacimiento, curso, email, contrasena)
                VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$curso', '$email', '$contrasena_hash')";

        if (mysqli_query($conexion, $sql)) {
            echo "<h2>Alumno/a añadido/a correctamente</h2>";
        } else {
            echo "<h2>Error al guardar los datos</h2>";
            echo "<p>" . mysqli_error($conexion) . "</p>";
        }
    }

    // Mostramos lo que se ha metido
    echo "El nombre ingresado es: " . htmlspecialchars($nombre) . "<br>";
    echo "Los apellidos ingresados son: " . htmlspecialchars($apellidos) . "<br>";
    echo "La fecha ingresada es: " . htmlspecialchars($fecha_nacimiento) . "<br>";
    echo "El curso ingresado es: " . htmlspecialchars($curso) . "<br>";
    echo "El email ingresado es: " . htmlspecialchars($email) . "<br>";
    echo "La contraseña ingresada es: [oculta por seguridad]<br>";

    echo '<p class="volver"><a href="../index.html">&larr; Volver al formulario</a> · <a href="listar.php">Ver listado</a></p>';

} else {
    echo "<p>No se ha recibido ningún dato.</p>";
    echo '<p class="volver"><a href="../index.html">&larr; Volver al formulario</a></p>';
}

mysqli_close($conexion);
?>

</body>
</html>