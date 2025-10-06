<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decimal a binario</title>
</head>
<body>
    <?php
        //Para convertir en binario dividimos el numero entre 0 sucesivamente y ordenamos los restos de abajo a arriba (al reves)
        $num1="168";
        $num2="128";
        $num3="127";
        $num4="1";
        $num5="2";
        
        //llamamos a la funcion
        convierte($num1);
        convierte($num2);
        convierte($num3);
        convierte($num4);
        convierte($num5);

        function convierte($num) {
            $decimal=$num;
            $binario="";
    
            while ($decimal > 0) {
                $resto = $decimal % 2; //guarda el resto
                $binario= $resto.$binario;
                $decimal=intdiv($decimal,2); //guarda el cociente 
            }

            echo "Numero $num en binario = $binario <br><br>";
        }
    ?>

</body>
</html>