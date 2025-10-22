<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichero 1 - Guardar alumnos</title>
</head>
<!--Programa fichero1.php: formulario que recoja los datos de alumnos y los almacene un fichero con
nombre alumnos1.txt (una fila por alumno). Los campos del fichero estarán separados por posiciones:
Nombre: posición 1 a 40
Apellido1: posición 41 a 81
Apellido2: posición 82 a 123
Fecha Nacimiento: posición 124 a 133
Localidad: posición 134 a 160
Las posiciones no ocupadas se completarán con espacios. -->
<body>
    <h2>Registro de alumnos</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Primer Apellido:</label><br>
        <input type="text" name="apellido1" required><br><br>

        <label>Segundo Apellido:</label><br>
        <input type="text" name="apellido2" required><br><br>

        <label>Fecha de Nacimiento:</label><br>
        <input type="date" name="fecha" required><br><br>

        <label>Localidad:</label><br>
        <input type="text" name="localidad" required><br><br>

        <input type="submit" name="enviar" value="Guardar Alumno">
    </form>

    <?php
        // -----------------------------------------------------------------
        // -----------------------------------------------------------------
        // LIMPIAR DATOS
        function test_input($data) {
            $data = trim($data); // Quita espacios al inicio y final
            $data = stripslashes($data); // Quita barras invertidas
            $data = htmlspecialchars($data); // Convierte caracteres especiales en HTML
            return $data;
        }
        // -----------------------------------------------------------------
        // -----------------------------------------------------------------
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // -------------------------------------------------------------
            // LIMPIA
            $nombre = test_input($_POST['nombre']);
            $apellido1 = test_input($_POST['apellido1']);
            $apellido2 = test_input($_POST['apellido2']);
            $fecha = test_input($_POST['fecha']);
            $localidad = test_input($_POST['localidad']);
            // -------------------------------------------------------------
            // Indica la ruta
            $ruta = "alumnos1.txt";   

            // Completamos con espacios hasta la longitud indicada
            $nombre = str_pad($nombre, 40);
            $apellido1 = str_pad($apellido1, 41);
            $apellido2 = str_pad($apellido2, 42);
            $fecha = str_pad($fecha, 10);
            $localidad = str_pad($localidad, 27);

            // Concatenar los campos
            $linea = $nombre . $apellido1 . $apellido2 . $fecha . $localidad . "\n";

            // Abrimos el fichero y escribimos la línea
            $file = fopen($ruta, "a");
            fwrite($file, $linea);
            fclose($file);

            echo "<p>Alumno guardado correctamente en <b>$ruta</b></p>";
        }
    ?>
</body>
</html>