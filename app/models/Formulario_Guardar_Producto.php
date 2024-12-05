<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = 'Automuelles2024*';
$database = 'automuelles';

// Crear conexión
$mysqli = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Procesar formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referencia = $_POST['referencia'];
    $nombre_producto = $_POST['nombre_producto'];
    $marca = $_POST['marca'];
    $linea = $_POST['linea'];
    $descripcion_producto = $_POST['descripcion_producto'];

    // Verificar si el producto ya existe
    $query = "SELECT COUNT(*) FROM productos WHERE referencia = ?";
    $stmt_check = $mysqli->prepare($query);
    $stmt_check->bind_param("s", $referencia);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        echo "<script>alert('El producto ya está creado.'); window.location.href='../../views/FormularioIngresoProductos.php';</script>";
    } else {
        // Procesar especificaciones técnicas
        $especificaciones = [];
        if (isset($_POST['especificacion_titulo']) && isset($_POST['especificacion_descripcion'])) {
            for ($i = 0; $i < count($_POST['especificacion_titulo']); $i++) {
                $especificaciones[] = [
                    'titulo' => $_POST['especificacion_titulo'][$i],
                    'descripcion' => $_POST['especificacion_descripcion'][$i]
                ];
            }
        }
        $especificaciones_json = json_encode($especificaciones);

        // Procesar la carga de imagen
        $imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $imagen_nombre = basename($_FILES["imagen"]["name"]); // Obtener solo el nombre de la imagen
            $target_dir = "../../public/img/img Producto/"; // Carpeta donde se guardarán las imágenes
            $target_file = $target_dir . $imagen_nombre;
            
            // Crear directorio si no existe
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $imagen = $imagen_nombre; // Solo guardar el nombre de la imagen
            } else {
                echo "Error al subir la imagen.";
            }
        }

        // Insertar datos en la base de datos
        $sql = "INSERT INTO productos (referencia, nombre_producto, marca, linea, descripcion_producto, especificaciones, imagen)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssssss", $referencia, $nombre_producto, $marca, $linea, $descripcion_producto, $especificaciones_json, $imagen);
            
            if ($stmt->execute()) {
                echo "<script>alert('Producto registrado exitosamente.'); window.location.href='../../views/FormularioIngresoProductos.php';</script>";
            } else {
                echo "Error al guardar el producto: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación de la consulta: " . $mysqli->error;
        }

        // Cerrar declaración
        $stmt->close();
    }
}

// Cerrar conexión a la base de datos
$mysqli->close();
?>