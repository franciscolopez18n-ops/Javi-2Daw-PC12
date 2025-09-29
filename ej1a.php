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
        $impares = [];
        $suma = 0;

        for ($i = 0; $i < 20; $i++) {
                $impares[$i] = 2 * $i + 1; //cualquier numero multiplicado por 2 es par entonces le sumamos 1
        }
        
        echo "<table border='1'cellspacing='0'>";
      
        echo "<tr>
                <th>Indice</th>
                <th>Valor</th>
                <th>Suma</th>
             </tr>";
     
        for ($i = 0; $i < count($impares); $i++) {
            $suma += $impares[$i]; 
            echo "<tr>
                    <td>$i</td>
                    <td>$impares[$i]</td>
                    <td>$suma</td>
                 </tr>";
         }

        echo "</table>";      
    ?>
</body>
</html>