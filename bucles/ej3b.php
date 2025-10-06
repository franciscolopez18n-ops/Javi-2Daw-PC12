<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>decimal a hexadecimal</title>
</head>
<body>
    <?php
        // Llamadas a la función
        convierte_hex(48);
        convierte_hex(222);
        convierte_hex(15);
        convierte_hex(1515);
        
        function convierte_hex($num) 
        {
            $base = 16;
            $contador = $num;
            $resultado = "";
            $digitos = "0123456789ABCDEF"; 

            while ($contador > 0) {
                $resto = $contador % $base;                
                $resultado = $digitos[$resto] . $resultado; //sacamos el caracter de la posicion indicada
                $contador = intdiv($contador, $base);             
            }

            if ($resultado == "") { 
                $resultado = "0";
            }

            echo "Número $num en base 16 = $resultado<br><br>";
        }

    ?>
    
</body>
</html>