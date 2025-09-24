<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php 
        //Realiza el mismo ejercicio sin usar sprintf
        $ip = "192.18.16.204";
        $binario = "";
        echo "<b>La IP $ip en binario es: </b>";
        echo "<br>";
        
        // 1er octeto
        $pos = strpos($ip, "."); //Busca la posicion del primer "." de la cadena (empieza en 0 --> pos=3)
        $parte1 = substr($ip, 0, $pos); //luego saca de la cadena N caracteres
        $ip = substr($ip, $pos + 1); //recortamos la cadena y repetimos

        // 2º octeto
        $pos = strpos($ip, ".");
        $parte2 = substr($ip, 0, $pos);
        $ip = substr($ip, $pos + 1);

        // 3er octeto
        $pos = strpos($ip, ".");
        $parte3 = substr($ip, 0, $pos);
        $ip = substr($ip, $pos + 1);

        // 4º octeto 
        $parte4 = $ip; //es lo ultimo


        // str_pad (cadena, numero caracteres, rellena a la izquierda/derecha) || decbin --> convierte el numero a binario
        $binario = str_pad(decbin($parte1), 8, "0", STR_PAD_LEFT) . "."
                . str_pad(decbin($parte2), 8, "0", STR_PAD_LEFT) . "."
                . str_pad(decbin($parte3), 8, "0", STR_PAD_LEFT) . "."
                . str_pad(decbin($parte4), 8, "0", STR_PAD_LEFT);

        echo "$binario<br>";
    ?>
    
</body>
</html>