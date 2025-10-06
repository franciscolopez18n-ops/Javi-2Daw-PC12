<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    <?php 
        $num1= 5;
        $num2= 4;

        factorial($num1);
        factorial($num2);

        function factorial($num){
            $resultado="1";
            
            echo "$num! = ";
            for ($i=$num; $i >0 ; $i--) {

                $resultado = $i*$resultado;
                if ($i>1) {
                   echo "$i"."x";
                } else {
                   echo "$i"."=". $resultado. "<br><br>";
                }
                
                
                
            }
            
        }

    
    
    ?>
</body>
</html>