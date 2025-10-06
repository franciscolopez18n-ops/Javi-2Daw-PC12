<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
<!-- 
    A partir de la dirección IP y la máscara de red, 
    Obtener:
        la dirección de red, 
        la dirección de broadcast 
        el rango de IPs disponibles para los equipos

    Ejemplo de salida para: IP 192.168.16.100/16
        Mascara 16
        Direccion Red: 192.168.0.0
        Direccion Broadcast: 192.168.255.255
        Rango: 192.168.0.1 a 192.168.255.254

     Clases de mascaras:
        Clase A -- máscara /8 -- 255.0.0.0
        Clase B -- máscara /16 -- 255.255.0.0 
        Clase C --  máscara /24 -- 255.255.255.0
        Clase D -- mascara /32 -- 255.255.255.255
-->
    
    <?php
        $ip1 = "192.168.16.100/16";
        $ip2 = "192.168.16.100/21";
        $ip3 = "10.33.15.100/8";

        //Llamamos a la funcion
        calcula($ip1);
        calcula($ip2);
        calcula($ip3);

        function calcula($ip_mask)  
        {
            // --- Separamos la IP del prefijo ---
            $pos= strpos($ip_mask, "/");
            $ip = substr($ip_mask, 0, $pos); 
            $mascara = substr($ip_mask, $pos+1); //guardamos la mascara
            
            // --- Dividimos la IP en cada parte ---
            $posicion = strpos($ip, ".");
            $p1= substr($ip, 0, $posicion); //10
            $resto = substr($ip, $posicion+1); //33.15.100

            $posicion = strpos($resto, ".");
            $p2= substr($resto, 0, $posicion); //33
            $resto = substr($resto, $posicion+1); //15.100

            $posicion = strpos($resto, ".");
            $p3= substr($resto, 0, $posicion); //15
            $resto = substr($resto, $posicion+1); //100

            $p4 = $resto; //100

            // --- 3. Calculamos --- 
            if ($mascara <= 8) //primer octete
            {
                $red = "$p1.0.0.0";
                $broadcast = "$p1.255.255.255";
                $rango = "$p1.0.0.1 a $p1.255.255.254";
            } 
            elseif ($mascara <= 16) //segundo octete
            {
                $red = "$p1.$p2.0.0";
                $broadcast = "$p1.$p2.255.255";
                $rango = "$p1.$p2.0.1 a $p1.$p2.255.254";
            } 
            elseif ($mascara <= 24) //tercer octete 
            {
                //calculamos el tamaño del bloque (2^num_bits)
                $num_bits = 24 - $mascara; 
                $tamaño_bloque = 2 ** $num_bits; 

                //calculamos el  primer numero permitido dentro del bloque (restamos lo que sobra)
                $inicio_bloque = $p3 - ($p3 % $tamaño_bloque);
                //calculamos el ultimo numero permitido dentro del bloque
                $fin_bloque_broadcast = $inicio_bloque + $tamaño_bloque - 1; 
                
                $red = "$p1.$p2.$inicio_bloque.0";
                $broadcast = "$p1.$p2.$fin_bloque_broadcast.255"; 
                $rango = "$p1.$p2.$inicio_bloque.1 a $p1.$p2.$fin_bloque_broadcast.254"; 
            } 
            else  //cuarto octete, mascaras desde /25 hasta /32
            { 
                $num_bits = 32 - $mascara;
                $tamaño_bloque = 2 ** $num_bits;

                //primer numero permitido dentro del bloque broadcast
                $inicio_bloque = $p4 - ($p4 % $tamaño_bloque);
                //ultimo numero permitido dentro del bloque
                $fin_bloque_broadcast = $inicio_bloque + $tamaño_bloque - 1; 

                $red = "$p1.$p2.$p3.$inicio_bloque";
                $broadcast = "$p1.$p2.$p3.$fin_bloque_broadcast";
                $rango = "$p1.$p2.$p3." . ($inicio_bloque + 1) . " a $p1.$p2.$p3." . ($fin_bloque_broadcast - 1);
            }
            
            // --- 4. Mostrar resultados ---
            echo "<b>IP:</b> $ip_mask<br>";
            echo "<b>Mascara:</b> $mascara<br>";
            echo "<b>Direccion Red:</b> $red<br>";
            echo "<b>Direccion Broadcast:</b> $broadcast<br>";
            echo "<b>Rango:</b> $rango<br><br><br><br>";
        }
    ?>
    
</body>
</html>