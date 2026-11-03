<html>
    <head>
        <title>Examen de Desarrollo web en entorno servidor</title>
        <link rel="icon" type="image/png" sizes="32x32" href="../imagenes/favicon.jpeg">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">

    </head>
    <body>
        <h1>Centro de Ayuda al Empleo</h1>
        <h2>    
            <?php
                $tipo = "Soldadura";
                if ($_REQUEST['tipo'] == 'informatica'){
                    $tipo = 'Informática';
                } elseif ($_REQUEST['tipo'] == 'socio'){
                    $tipo = "Asistencia Sociosanitaria";
                }
                echo "Solicitudes de $tipo";
            ?>
        </h2>

        
        <?php 
        // Aquí tenéis que crear la tabla de solicitantes de ese tipo
        $conn = mysqli_connect("localhost", "root", "", "CAE");
        $profesion = $_REQUEST['tipo'];


        // Insertar datos en la tabla SOLICITUD si vienen datos del formulario
            if (isset($_POST['nombre'])) {
                $jornadaParcial = 0;
                if ($_POST['jornada'] == 'parcial') {
                    $jornadaParcial = 1;
                }
                $idiomas = "Ninguno";
                if (isset($_POST['idioma'])) {
                    $idiomas = implode(", ", $_POST['idioma']);
                }
                mysqli_query($conn, "INSERT INTO SOLICITUD (nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas)
                  VALUES ('$_POST[nombre]', '$_POST[apellidos]', '$_POST[DNI]', '$_POST[fecha_Nacimiento]', '$_POST[telefono]', '$_POST[email]', '$profesion', '$jornadaParcial', '$idiomas')");
            }

            // Tabla de solicitantes de ese tipo
            $resultado = mysqli_query($conn, "SELECT * FROM SOLICITUD WHERE profesion = '$profesion'");
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Fecha nac.</th><th>Teléfono</th><th>Email</th><th>Jornada</th><th>Idiomas</th></tr>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $jornada = "Completa";
                if ($fila['jornadaParcial'] == 1) {
                    $jornada = "Parcial";
                }
            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['dni'] . "</td>";
            echo "<td>" . $fila['f_nac'] . "</td>";
            echo "<td>" . $fila['tlf'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td>" . $jornada . "</td>";
            echo "<td>" . $fila['idiomas'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <button onclick="location.href='../html/index.html'">Volver al formulario</button>
    </body>
</html>