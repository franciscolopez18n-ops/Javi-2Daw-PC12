<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Programa ej3a.php definir un array y almacenar los 20 primeros números binarios. Mostrar en la salida una tabla como la de la figura-->
    <?php
        $decimales = [];
        for ($i = 0; $i < 20; $i++) {
            $decimales[$i] = $i;
        }

        //creamos la tabla y los encabezados
        echo "<table border='1' cellspacing='0'>";
        echo "<tr>
                <th>Indice</th>
                <th>Binario</th>
                <th>Octal</th>
             </tr>";
        
        //para cada posicion calculamos el binario y el octal y creamos las celdas, $valor representa a cada objeto del array
        foreach ($decimales as $i => $valor) {
            $binario = binario($valor);
            $octal = octal($valor);
            echo "<tr>
                        <td>$i</td>
                        <td>$binario</td>
                        <td>$octal</td>    
                 </tr>";
        }
        echo "</table>";

        // Función para convertir decimal a binario usando bucles
        function binario($num) {
            if ($num == 0){
                return "0";
            }
            $binario = "";
            while ($num > 0) {
                $resto = $num % 2;
                $binario = $resto . $binario;
                $num = intval($num / 2);
            }
            return $binario;
        }

        // Función para convertir decimal a octal usando bucles
        function octal($num) {
            if ($num == 0){
                return "0";
            }
            $octal = "";
            while ($num > 0) {
                $resto = $num % 8;
                $octal = $resto . $octal;
                $num = intval($num / 8);
            }
            return $octal;
        }
    ?>
</body>
</html>