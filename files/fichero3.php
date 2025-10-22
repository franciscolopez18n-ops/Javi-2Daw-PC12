<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichero 3 - Mostrar alumnos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Listado de Alumnos</h2>

    <?php
        $ruta = "alumnos1.txt";

        if (!file_exists($ruta)) {
            echo "<p style='text-align:center; color:red;'>El fichero <b>$ruta</b> no existe.</p>";
            exit;
        }

        // Abrimos el fichero en modo lectura
        $contenido = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $numFilas = count($contenido);

        if ($numFilas > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Apellido2</th>
                    <th>Fecha Nacimiento</th>
                    <th>Localidad</th>
                </tr>";

            foreach ($contenido as $linea) {
                // Extraemos cada campo según posiciones fijas
                $nombre = trim(substr($linea, 0, 40));
                $apellido1 = trim(substr($linea, 40, 41));
                $apellido2 = trim(substr($linea, 81, 42));
                $fecha = trim(substr($linea, 123, 10));
                $localidad = trim(substr($linea, 133, 27));

                echo "<tr>
                        <td>$nombre</td>
                        <td>$apellido1</td>
                        <td>$apellido2</td>
                        <td>$fecha</td>
                        <td>$localidad</td>
                    </tr>";
            }

            echo "</table>";
            echo "<p style='text-align:center;'>Número de alumnos leídos: <b>$numFilas</b></p>";
        } else {
            echo "<p style='text-align:center;'>No hay alumnos en el fichero.</p>";
        }
    ?>
</body>
</html>
