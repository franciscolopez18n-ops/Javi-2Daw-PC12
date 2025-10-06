<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Programa ej4a.phpa partir del array definido en el ejercicio anterior crear un nuevo array que almacene los números binarios en orden inverso.-->
    <?php
        echo "<h3>Arrays de los primeros 20 numeros binarios</h3>";
        $decimales = [];
        for ($i = 0; $i < 20; $i++) {
            $decimales[$i] = $i;
        }

        //crear array con los números binarios
        $binarios = [];    
         foreach ($decimales as $i => $valor) {
            $binarios[] = decimal_a_binario($valor); //pasa el valor de cada objeto del array $decimales
        }

        //recorremos el array al reves y lo guardamos
        $binarios_invertidos = [];
        for ($i = count($binarios) - 1; $i >= 0; $i--) {
            $binarios_invertidos[] = $binarios[$i]; //RESTAMOS porque no existe la ultima posicion, ejemplo: un array de 20 => la ultima posicion es la [19], lo creamos vacio y vamos añadiendo
        }
        
        // Función para convertir decimal a binario
        function decimal_a_binario($num) {
            $binario = "";
            if ($num == 0){
                return "0";
            }
            //calcula
            while ($num > 0) {
                $resto = $num % 2;
                $binario = $resto . $binario;
                $num = intval($num / 2);
            }
            return $binario;
        }

        echo "<table border='1px' cellspacing='0'>";
        echo "<tr>
                <th>Array normal </th>
                <th>Array invertido </th>
             </tr>";

        for ($i=0; $i < count($binarios); $i++) { 
            echo "<tr>
                    <td>$binarios[$i]</td>
                    <td>$binarios_invertidos[$i]</td>
                 </tr>";
        }
        echo "</table>";

    ?>
</body>
</html>