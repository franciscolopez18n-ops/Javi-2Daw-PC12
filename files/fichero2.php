<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichero 2 - Guardar alumnos</title>
</head>
<!--Programa fichero2.php: formulario que recoja los datos de alumnos y los almacene un fichero con
nombre alumnos2.txt (una fila por alumno). Los campos del fichero estarán separados utilizando como
caracteres delimitadores ##
Nombre##Apellido1##Apellido2##Fecha Nacimiento##Localidad
No se completarán con espacios los campos puesto que se separan por caracteres delimitadores. -->
<body>
    <h2>Registro de alumnos (delimitador ##)</h2>

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
            // Recoge los datos           
            $nombre = test_input($_POST['nombre']);
            $apellido1 = test_input($_POST['apellido1']);
            $apellido2 = test_input($_POST['apellido2']);
            $fecha = test_input($_POST['fecha']);
            $localidad = test_input($_POST['localidad']);
        // -----------------------------------------------------------------
        // -----------------------------------------------------------------
            $ruta = "alumnos2.txt";
            // Concatenamos con ##
            $linea = $nombre . "##" . $apellido1 . "##" . $apellido2 . "##" . $fecha . "##" . $localidad . "\n";

            // Abrimos el fichero y escribimos
            $file = fopen($ruta, "a");
            fwrite($file, $linea);
            fclose($file);

            echo "<p>Alumno guardado correctamente en <b>$ruta</b></p>";
        }
    ?>
</body>
</html>
</body>
</html>