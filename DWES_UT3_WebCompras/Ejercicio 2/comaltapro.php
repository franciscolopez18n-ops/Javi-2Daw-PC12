<?php 
    // LIMPIA DATOS
    function test_input($data) {
        $data = trim($data); // Quita espacios al inicio y final
        $data = stripslashes($data); // Quita barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en HTML
        return $data;
    }

    // CONEXIÓN
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="comprasweb";

    // ESTRUCTURA
    try {
        $con = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password); // CREA LA CONEXION
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // LLAMA AL BLOQUE CATCH
    } catch (Exception $e) {
        echo "Error de conexión " . $e->getMessage();
    }

    // ALTA DE PRODUCTO
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = strtoupper(test_input($_POST['nombre_producto']));
        $precio = test_input($_POST['precio']);
        $categoria = test_input($_POST['categoria']);

        // LLAMAMOS A LA FUNCION PARA EL ID
        $id_nuevo = generar_id_producto($con);

        try {
            // PREPARA LA SENTENCIA
            $stmt = $con->prepare("INSERT INTO producto (ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA) 
                                   VALUES (:ID_PRODUCTO, :NOMBRE, :PRECIO, :ID_CATEGORIA)");
            // INDICAMOS LOS VALORES
            $stmt->bindParam(':ID_PRODUCTO', $id_nuevo);
            $stmt->bindParam(':NOMBRE', $nombre);
            $stmt->bindParam(':PRECIO', $precio);
            $stmt->bindParam(':ID_CATEGORIA', $categoria);

            // COMPROBAMOS SI YA EXISTE UN PRODUCTO CON ESE NOMBRE, SI NO EXISTE LO CREA
            if (!comprueba_existe($con, $nombre)) {
                $stmt->execute();
                echo "<br>Producto <b>$nombre</b> insertado con ID <b>$id_nuevo</b>";
            }
        } catch(Exception $e) {
            echo "<br>Error al insertar: " . $e->getMessage();
        }
    }

    // GENERA EL ID_PRODUCTO Pxxxx
    function generar_id_producto($con){
        $sql = "SELECT MAX(ID_PRODUCTO) AS ultimo_id FROM producto"; // SENTENCIA (CON ALIAS), 'ultimo_id' es igual a 'MAX(ID_PRODUCTO)'
        $stmt = $con->prepare($sql); // LA PREPARA
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // LA GUARDAMOS EN UN ARRAY ASOCIATIVO (SI ES NULL NO SE EJECUTA EL IF)

        // SI DEVUELVE FILAS INCREMENTA EL ID
        if($result){
            $ultimo = $result['ultimo_id']; // Guardamos el valor de la ultima fila que cargo el FETCH (P0000X)
            $numero = intval(substr($ultimo,1)); // Guardamos la parte numerica y la convertimos a entero (P0012 --> 0012 --> 12)
            $nuevo_num = $numero + 1;
        } 
        // SI O EXISTE CREA EL PRIMER PRODUCTO
        else {
            $nuevo_num = 1;
        }

        $completa_id = "P" . str_pad($nuevo_num,4,"0",STR_PAD_LEFT); // Completamos el ID
        return $completa_id;
    }

    // Comprobar existencia del producto
    function comprueba_existe($con, $nombre){
        $sql = "SELECT COUNT(*) AS total FROM producto WHERE NOMBRE = :nombre";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Guardamos lo que devuelve

        // SI YA EXISTE SACAMOS EL ID
        if($result['total'] > 0){
            $sql = "SELECT ID_PRODUCTO FROM producto WHERE NOMBRE = :nombre";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $id = $stmt->fetch(PDO::FETCH_ASSOC); // Guardamos el id
            // Imprimimos
            echo "<br>El producto <b>$nombre</b> ya existe con ID <b>".$id['ID_PRODUCTO']."</b>";
            return true;
        }
        return false;
    }

    // PARA CARGAR LAS CATEGORIAS (LLAMAMOS LA FUNCION DESDE EL HTML)
    function cargar_categorias($con){
        $sql = "SELECT ID_CATEGORIA, NOMBRE FROM categoria ORDER BY NOMBRE";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        // BUCLE WHILE QUE SE EJECUTA MIENTRAS CARGUE FILAS
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$fila['ID_CATEGORIA']."'>".$fila['NOMBRE']."</option>";
        }
    }

    // Mostrar tabla de productos
    function mostrar_filas_producto($con){
        try {
            // PREPARAMOS LA SENTENCIA Y LA EJECUTAMOS
            $sql = "SELECT ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA FROM producto ORDER BY ID_PRODUCTO";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            // SI NO CARGA NINGUNA FILA
            if($stmt->rowCount() == 0){
                echo "<h2>No hay productos registrados</h2>";
     
            }
            // SI CARGA ALGUNA FILA MUESTRA LA TABLA
            else{
                echo "<h2>Listado de Productos</h2>";
                echo "<table border='1' cellpadding='8' cellspacing='0'>
                        <tr>
                            <th>ID_PRODUCTO</th>
                            <th>NOMBRE_PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>ID_CATEGORIA</th>
                            <th>NOMBRE_CATEGORIA</th>
                        </tr>";
                // RECORREMOS LAS FILAS 
                while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $nombre_cat = nombre_categoria($con, $fila['ID_CATEGORIA']);
                    echo "<tr>
                            <td>".$fila['ID_PRODUCTO']."</td>
                            <td>".$fila['NOMBRE']."</td>
                            <td>".$fila['PRECIO']."</td>
                            <td>".$fila['ID_CATEGORIA']."</td>
                            <td>".$nombre_cat."</td>
                        </tr>";
                }
                echo "</table>";
            }
        } catch(Exception $e){
            echo "Error al mostrar productos: ".$e->getMessage();
        }
    }
    function nombre_categoria($con, $id_categoria){
        $sql = "SELECT NOMBRE FROM categoria WHERE ID_CATEGORIA = :ID_CATEGORIA"; 
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':ID_CATEGORIA', $id_categoria); // INDICAMOS EL VALOR DE ':ID_CATEGORIA'
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Guardamos la salida

        // Comprueba si es null
        if ($result !="") {
            return $result['NOMBRE'] ;
        }
        else{
            return "-";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta productos</title>
</head>
    <body>
        <h1>Alta de Productos</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" name="nombre_producto" id="nombre" required><br><br>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" id="precio" required><br><br>

            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" required>
                <?php cargar_categorias($con); ?>
            </select><br><br>

            <input type="submit" value="Añadir Producto">
        </form>

        <?php mostrar_filas_producto($con);?> <!-- Mostrar productos después del formulario -->
    </body>
</html>