<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        //Debemos de sumar los indices pares y los impares por otro lado
        $impares = [];
        $suma = 0; 

        //Pares
        $suma_pares = 0;
        $contador_pares = 0;
        //Impares
        $suma_impares = 0;
        $contador_impares = 0;
   
        // Crear array de los 20 primeros impares
        for ($i = 0; $i < 20; $i++) {
            $impares[$i] = 2 * $i + 1;
        }

        echo "<table border='1' cellspacing='0'>";
        echo "<tr>
                <th>Indice</th>
                <th>Valor</th>
                <th>Suma</th>
            </tr>";

        //Segun la posicion vamos a ir sumando y aumentando los contadores
        for ($i = 0; $i < count($impares); $i++) 
        {
            $suma += $impares[$i]; 
            echo "<tr>
                    <td>$i</td>
                    <td>$impares[$i]</td>
                    <td>$suma</td>
                </tr>";
            
            //calculamos
            if ($i % 2 == 0) {
                $suma_pares += $impares[$i];
                $contador_pares++;
            } 
            else {
                $suma_impares+=$impares[$i];
                $contador_impares++;
            }
        }

        echo "</table><br>";

        //calculamos las medias de las posiciones pares e impares
        $media_pares=$suma_pares/$contador_pares;
        $media_impares=$suma_impares/$contador_impares;

        echo "<b>Media de posiciones pares:</b> $media_pares <br>";
        echo "<b>Media de posiciones impares:</b> $media_impares";
    ?>

</body>
</html>