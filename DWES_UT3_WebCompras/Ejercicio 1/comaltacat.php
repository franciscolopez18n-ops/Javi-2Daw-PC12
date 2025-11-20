<!--Alta de Categorías (comaltacat.php): dar de alta categorías de productos. El id_categoria
será un campo con el formato C-xxx donde xxx será un número secuencial que comienza en 1
completándose con 0 hasta completar el formato (este campo será calculado desde PHP).-->
<?php 
    function test_input($data) {
        $data = trim($data); // Quita espacios al inicio y final
        $data = stripslashes($data); // Quita barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en HTML
        return $data;
    }
    // VALORES
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // LIMPIA Y PASA A MAYUSCULAS
        $nombre = strtoupper(test_input($_POST['nombre_categoria']));
        $id_nuevo = generar_id($con);

        // INTENTAMOS INSERTAR LOS VALORES
        try {
            // PREPARA LA SENTENCIA
            $stmt = $con->prepare("INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:ID_CATEGORIA,:NOMBRE)");

            // INDICAMOS LOS VALORES
            $stmt->bindParam(':ID_CATEGORIA', $id_nuevo); // LLAMA A LA FUNCION
            $stmt->bindParam(':NOMBRE', $nombre); // RECIBE EL NOMBRE
            
            // COMPROBAMOS SI YA EXISTE UNA CATEGRIA CON ESE NOMBRE, SI NO EXISTE LA CREA
            if ( !comprueba_existe($con, $nombre)) {
                $stmt->execute();
                echo "<br>Categoría <b>$nombre</b> insertada con ID <b>$id_nuevo</b>";
            }
            echo "<h2>FILAS DE LA TABLA CATEGORIA</h2>";
            // Para mostrar las filas
            mostrar_filas($con);
        } catch (Exception $e) {
            echo "<br>Error al insertar: " . $e->getMessage();
        }

        $conn = null;

    }
    // Recibe la conexion y devuelve el id_categoria
    function generar_id($con){
        $sql = "SELECT MAX(ID_CATEGORIA) AS ultimo_id FROM categoria"; // CREAMOS LA SENTENCIA (PONEMOS UN ALIAS PARA REFERIRNOS A "MAX(ID_CATEGORIA)")
        $stmt = $con->prepare($sql); // PREPARAMOS LA SENTENCIA 
        $stmt->execute(); // EJECUTAMOS LA SENTENCIA
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // GUARDAMOS LA SALIDA EN UN ARRAY ASOCIATIVO (SI NO TIENE NADA SERA NULL), FETCH CARGA UNA SOLA LINEA


        // SI EXISTE LA INCREMENTA 
        if($result){
            $ultimo_id =$result['ultimo_id']; // Guardamos el valor de la ultima fila que cargo el FETCH (C-00X)
            $numero = intval(substr($ultimo_id,2)); // Guardamos la parte numerica y la convertimos a entero
            // substr (cadena, inicio) sacamos la parte numerica; intval-convierte a entero (012 --> 12)
            $id_nuevo = $numero + 1;
        } 
        // SI NO EXISTE (NULL) ENTONCES LA CREA
        else {
            $id_nuevo = 1;
        }
        $completa_id = "C-" . str_pad($id_nuevo,3,"0",STR_PAD_LEFT); // Completamos el ID
        return $completa_id;
    }

    function comprueba_existe($con, $nombre){
        $sql = "SELECT COUNT(*) AS total FROM categoria WHERE NOMBRE = :nombre";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Guardamos lo que devuelve

        // Si es mayor a 0 entonces ya existe
        if($result['total'] > 0){
            // Para indicar el ID de la categoria
            $sql = "SELECT ID_CATEGORIA AS id_repetido FROM categoria WHERE NOMBRE = :nombre";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $id = $stmt->fetch(PDO::FETCH_ASSOC); 
            echo "<br>La categoría <b>$nombre</b> ya existe con ID <b>$id[id_repetido]</b>";
            return true; // Existe
        } else {
            return false; // No existe
        }
    }

    function mostrar_filas($con){
        try {
            // Para recorrer las filas
            $sql = "SELECT ID_CATEGORIA, NOMBRE FROM categoria ORDER BY ID_CATEGORIA";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            // Devuelve el numero de filas que devuelve la sentencia
            if ($stmt->rowCount() == 0) {
                echo "<h2>No hay categorías registradas.</h2>";
            }
            // Si devuelve mas de una la imprime
            else{
                echo "<table border='1' cellpadding='8' cellspacing='0'>";
                echo "<tr>
                        <th>ID_CATEGORIA</th>
                        <th>NOMBRE</th>
                      </tr>";
                // Recorremos
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                        echo "<td>" . $fila['ID_CATEGORIA'] . "</td>";
                        echo "<td>" . $fila['NOMBRE'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
        } catch (Exception $e) {
            echo "Error al mostrar categorías: " . $e->getMessage();
        }
    }


            




?>