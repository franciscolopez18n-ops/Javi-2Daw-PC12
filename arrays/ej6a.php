<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6a</title>
</head>
<body>
    <h2>Ejercicio 6a - Mostrar array en orden inverso sin el módulo "Mecanizado"</h2>

    <?php
        $array1 = ["Bases Datos", "Entornos Desarrollo", "Programación"];
        $array2 = ["Sistemas Informáticos", "FOL", "Mecanizado"];
        $array3 = ["Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés"];

        // Unimos los arrays 
        $union = array_merge($array1, $array2, $array3);

        // Eliminamos el módulo "Mecanizado"
        $busca = array_search("Mecanizado", $union); // buscamos su posición
        if ($busca !== false) {
            unset($union[$busca]); // lo eliminamos
        }

        // Mostramos el array resultante en orden inverso
        $array_inverso = array_reverse($union);

        echo "<h3>Array sin 'Mecanizado' y en orden inverso:</h3>";
     
        print_r($array_inverso);
    ?>
</body>
</html>
