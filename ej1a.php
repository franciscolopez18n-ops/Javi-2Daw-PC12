<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>20 impares</title>
</head>
<body>
    <!--
        Recordar: 
            tr: crea fila
            td: crea una celda en esa fila, seria crear columnas
            th: crea encabezados en esa fila
    -->
    <?php 
        $impares1 = [];
        $impares2 = [];

        bucle_for($impares1);
        bucle_while($impares2);

        //Para guardar en el array
        function bucle_for($impares){
            echo "<h2>Usando un bucle for: </h2><br>";
            for ($i = 0; $i < 20; $i++) {
                $impares[$i] = 2 * $i + 1; //cualquier numero multiplicado por 2 es par entonces le sumamos 1
            }
            crea_tabla($impares);
        }
        function bucle_while($impares){
            echo "<h2>Usando un bucle While: </h2><br>";
            $numero = 0;
            $i = 0;  

            while (count($impares) < 20) { 
                $numero++;
                if ($numero % 2 != 0) { // si es impar
                    $impares[$i] = $numero;
                    $i++; 
                }
            }
            crea_tabla($impares);
        }
        //Para crear la tabla
        function crea_tabla($impares){
            echo "<table border='1'cellspacing='0'>";
            //creamos los encabezados
            echo "<tr>
                    <th>Indice</th>
                    <th>Valor</th>
                    <th>Suma</th>
                 </tr>";
            //creamos las celdas
            $suma = 0;
            for ($i = 0; $i < count($impares); $i++) {
                $suma += $impares[$i]; 
                echo "<tr>
                        <td>$i</td>
                        <td>$impares[$i]</td>
                        <td>$suma</td>
                     </tr>";
            }

            echo "</table>";
            echo "<br><br>";
        }
        
    ?>
</body>
</html>