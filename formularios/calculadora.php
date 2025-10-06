<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <h1>CALCULADORA</h1>

    <?php 
        // LIMPIAMOS Y RECOGEMOS
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['operando1'])) $operando1 = test_input($_POST["operando1"]);
            if ($operando1=="")echo "Falta el primer operador <br>"; 

            if (isset($_POST['operando2'])) $operando2 = test_input($_POST["operando2"]);
            if ($operando2=="")echo "Falta el segundo operador <br>"; 

            if (!empty($_POST['operacion'])) $operacion = test_input($_POST["operacion"]);
            else echo "Falta seleccionar la operacion"; 
        }
        
        if (((isset($_POST['operando1']) and $operando1!="") and (isset($_POST['operando2']) and $operando2!="")) and isset($_POST['operacion'])) {
            switch ($operacion) {
                case "suma":
                    $resultado = sumar($operando1, $operando2);
                    echo "Resultado operacion: $operando1",'+',"$operando2 = ", $resultado;
                    break;
                case "resta":
                    $resultado = restar($operando1, $operando2);
                    echo "Resultado operacion: $operando1",'-',"$operando2 = ", $resultado;

                    break;
                case "producto":
                    $resultado = multiplicar($operando1, $operando2);
                    echo "Resultado operacion: $operando1",'*',"$operando2 = ", $resultado;;
                    break;
                case "division":
                    $resultado = dividir($operando1, $operando2);
                    echo "Resultado operacion: $operando1",'/',"$operando2 = ", $resultado;
                    break;
            }
        }

        // OPERACIONES
        function sumar($operando1, $operando2) {
            return $operando1 + $operando2;
        }
        function restar($operando1, $operando2) {
            return $operando1 - $operando2 ;
        }
        function multiplicar($operando1, $operando2) {
            return $operando1 * $operando2 ;
        }
        function dividir($operando1, $operando2) {
            if ($operando2 == 0) {
                return "Error: no se puede dividir entre cero.";
            }
            return $operando1 / $operando2;
        }

        // LIMPIAR
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
</body>
</html>