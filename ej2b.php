<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cualquier base</title>
</head>
<body>
    <!--Transformar un número decimal a cualquier otra base (base 2 a base 9) usando
    bucles (no se podrán utilizar las funcionesde conversión)-->

    <?php 
        //numero
        $num = 48;
        //bases
        $base1 = 8;
        $base2 = 2;
        $base3 = 4;
        $base4 = 6;
        //llama a la funcion
        convierte($num, $base1);
        convierte($num, $base2);
        convierte($num, $base3);
        convierte($num, $base4);

        function convierte($num, $base) {
            $repeticion = $num;
            $resultado = "";

            while ($repeticion > 0) {
                $resto = $repeticion % $base;         
                $resultado = $resto . $resultado;
                $repeticion = intval($repeticion/$base);     
            }

            if ($resultado == "") {
                $resultado = "0";
            }

            if ($base == 2) {
                $resultado = str_pad($resultado, 8, "0", STR_PAD_LEFT);
            }

            echo "Número $num en base $base = ". $resultado."<br><br>";
        }
        
    
    ?>
</body>
</html>