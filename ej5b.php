<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar en tabla</title>
</head>
<body>

    <?php
        tabla(8);

        function tabla($num) {
            echo "<table border='1px' cellspacing='0'>"; //creamos la tabla

                for ($i = 1; $i <= 10; $i++) {
                    $resultado = $num * $i;
                    echo "<tr>";
                        echo "<td>$num x $i</td>";
                        echo "<td>$resultado</td>";
                    echo "</tr>";
                }

            echo "</table>"; 
        }
       
    ?>
    
</body>
</html>