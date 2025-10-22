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
            }
            th, td {
                border: 1px solid #333;
       
            }
        </style>
    </head>
    <body>
        <h2>Listado de Alumnos</h2>

        <?php
            $ruta = "alumnos1.txt";

            // Abrimos el fichero o mostramos error
            $file = fopen($ruta, "r") or die("<p>No se pudo abrir el fichero <b>$ruta</b></p>");

            // Leemos todo el contenido del fichero
            $contenido = fread($file, filesize($ruta));
            fclose($file);

            // Dividimos la cadena en partes y la guardamos en un array
            $lineas = explode("\n", $contenido);

            $numFilas = 0;

            echo "<table>";
            echo "<tr>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Apellido2</th>
                    <th>Fecha Nacimiento</th>
                    <th>Localidad</th>
                </tr>";

            foreach ($lineas as $linea) {
                if (trim($linea) === "") continue; // Si la linea esta vacia no hay alumno y pasa a la siguiente iteracion

                $numFilas++;
            
                // Sacamos las partes de las cadenas y las guardamos en las variables
                $nombre    = trim(substr($linea, 0, 40));
                $apellido1 = trim(substr($linea, 40, 41));
                $apellido2 = trim(substr($linea, 81, 42));
                $fecha     = trim(substr($linea, 123, 10));
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
            echo "<p>Número de alumnos leídos: <b>$numFilas</b></p>";
        ?>
    </body>
</html>
