<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <h1>CALCULADORA</h1>

    <form action="" method="post">
        <label for="operando1">Operando1:</label>
        <input type="text" name='operando1' id="operando1"><br><br>
        <label for="operando2">Operando2:</label>
        <input type="text" name='operando2'><br><br><br>

        Selecciona operación: <br>
        <input type="radio" name='operacion' id="suma" value="suma">
        <label for="suma">Suma</label><br> <!--Al pulsar "Suma" se marcara el boton, el php recibe el value-->
        
        <input type="radio" name='operacion' id="resta" value="resta">
        <label for="resta">Resta</label><br>
        
        <input type="radio" name='operacion' id="producto" value="producto">
        <label for="producto">Producto</label><br>
        
        <input type="radio" name='operacion' id="division" value="division">
        <label for="division">División</label><br>

        <!--Enviar o borrar-->
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">

    </form>
</body>
</html>
<br>
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
                return "Error: no se puede dividir entre cero";
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