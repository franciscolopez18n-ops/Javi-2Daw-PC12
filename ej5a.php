<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <!--Definir tres arrays con los siguientes valores relativos a módulos que se imparten en el ciclo DAW:
            “Bases Datos”, “Entornos Desarrollo”, “Programación”
            “Sistemas Informáticos”,”FOL”,”Mecanizado"
            “Desarrollo Web ES”,”Desarrollo Web EC”,”Despliegue”,”Desarrollo Interfaces”, “Inglés”

        Se pide:
            Unir los 3 arrays en uno único sin utilizar funciones de arrays
            Unir los 3 arrays en uno único usando la función array_merge()
            Unir los 3 arrays en uno único usando la función array_push()
    -->

    <?php 

        //definimos los arrays
        $array1 = ["Bases Datos", "Entornos Desarrollo", "Programación"];
        $array2 = ["Sistemas Informáticos", "FOL", "Mecanizado"];
        $array3 = ["Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés"];

        // --------------------------------------------------
        //a) Unir los 3 arrays sin usar funciones de arrays, lo hacemos concatenando
        $union1 = [];
        foreach ($array1 as $valor) {
            $union1[] = $valor;
        }
        foreach ($array2 as $valor) {
            $union1[] = $valor;
        }
        foreach ($array3 as $valor) {
            $union1[] = $valor;
        }

        echo "<h3>a) Unión manual:</h3>";
        echo "<pre>"; //pre controla la estructura
        print_r($union1);
        echo "</pre>"; 

        // --------------------------------------------------
        //b) Unir los 3 arrays usando array_merge(), indicamos los arrays
        $union2= array_merge($array1, $array2, $array3);

        echo "<h3>b) Unión con la funcion array_merge():</h3>";
        echo "<pre>";
        print_r($union2);
        echo "</pre>";

        // --------------------------------------------------
        //c) Unir los 3 arrays usando array_push()
        $union_push = $array1; // partimos del primer array
        array_push($union_push, ...$array2); // añadimos todos los elementos de $array2
        array_push($union_push, ...$array3); // añadimos todos los elementos de $array3

        echo "<h3>c) Unión con array_push():</h3>";
        echo "<pre>";
        print_r($union_push);
        echo "</pre>";

    ?>
    
    
    
    

    








</body>
</html>