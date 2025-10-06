<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convierte a binario</title>
</head>
<body>

<?php
    /************ Sin explode *********************/
    // Vamos a sacar la posicion del "." y recorremos la cadena hasta esa posicion, luego recortamos la cadena y repetimos para cada parte       
    echo "<b>Si lo hacemos SIN explode:</b><br>";
    $ip = "192.18.16.204";
    echo "La IP $ip en binario es: ";
    $binario = "";

    // 1er octeto
    $pos = strpos($ip, "."); //comienza en 0
    $parte1 = substr($ip, 0, $pos); //guardamos la primera parte
    $ip = substr($ip, $pos + 1); //recortamos la cadena (como comienza en 0 le sumamos 1 para no incluir el ".")

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

    // Convertimos a binario
    $binario = sprintf("%08b", $parte1) . "."
            . sprintf("%08b", $parte2) . "."
            . sprintf("%08b", $parte3) . "."
            . sprintf("%08b", $parte4);

    echo "$binario<br>";
    echo "<br>";
    /************ Con explode *********************/       
    echo "<b>Si lo hacemos CON explode:</b><br>";

    $ip2="10.33.161.2";
    $divide=explode(".", $ip2); //crea un array y en cada posicion hay una parte
    $binario="";

    //Para concatenar cadenas usamos "." 
    for ($i=0; $i < count($divide); $i++) { 
        $binario.= sprintf("%08b", $divide[$i]); //va concatenando

        //Añadimos "." menos en la ultima posicion
         if ($i < count($divide) - 1) {
            $binario .= ".";
        }
    }

    echo "La IP $ip2 en binario es: ".$binario;
?>


    
</body>
</html>