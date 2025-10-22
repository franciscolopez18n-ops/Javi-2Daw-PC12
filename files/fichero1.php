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

    <form method="post" action="">
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
    if (isset($_POST['enviar'])) {
        $ruta = "alumnos1.txt";

        // Completamos con espacios
        $nombre    = str_pad($_POST['nombre'], 40);
        $apellido1 = str_pad($_POST['apellido1'], 41);
        $apellido2 = str_pad($_POST['apellido2'], 42);
        $fecha     = str_pad($_POST['fecha'], 10);
        $localidad = str_pad($_POST['localidad'], 27);

        // Concatenamos la línea
        $linea = $nombre . $apellido1 . $apellido2 . $fecha . $localidad . "\n";

        // Abrimos el fichero y escribimos la linea
        $file = fopen($ruta, "a");
        fwrite($file, $linea);
        fclose($file);

        echo "<p>Alumno guardado correctamente en <b>$ruta</b></p>";
    }
    ?>
</body>
</html>