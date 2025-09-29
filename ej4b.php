<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Multiplicar</title>
</head>
<body>
    <?php
        $num="8";
        $resultado="";
        for ($i=0; $i <= 10 ; $i++) { 
            
            $resultado = $num*$i;

            echo "$num"." x $i = ".$resultado."<br>";
        }


    ?>
    
</body>
</html>