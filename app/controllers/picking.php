<?php
session_start(); // Inicia la sesión

if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
}
// Datos de conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = 'Automuelles2024*';
$database = 'automuelles';

// Crear una nueva conexión a la base de datos
$mysqli = new mysqli($host, $user, $password, $database);

// Verificar si hay algún error en la conexión
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Verificar si el formulario de actualización se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los parámetros del formulario
    $transaccion = isset($_POST['transaccion']) ? $_POST['transaccion'] : '';
    $documento = isset($_POST['documento']) ? $_POST['documento'] : '';
    
    // Obtener el nombre de usuario desde la sesión
    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario']; // Asegúrate de que la sesión tiene el valor
    } else {
        die('No se ha encontrado el nombre de usuario en la sesión.');
    }

    // Iniciar una transacción para asegurar la integridad de los datos
    $mysqli->begin_transaction();

    try {
        // Consulta SQL para actualizar el estado de la factura
        $sqlUpdate = "UPDATE Facturas SET Estado = 'RevisionComenzada' WHERE IntTransaccion = ? AND IntDocumento = ?";
        $stmtUpdate = $mysqli->prepare($sqlUpdate);
        $stmtUpdate->bind_param('ii', $transaccion, $documento);
        $stmtUpdate->execute();

        // Verificar si la consulta ha fallado
        if ($stmtUpdate->error) {
            throw new Exception("Error en la actualización: " . $stmtUpdate->error);
        }

        // Consulta SQL para insertar el registro en la tabla `estados`
        $sqlInsert = "INSERT INTO estados (EstadoActual, FechaEstadoActual, NombreUsuario, IntDocumento, IntTransaccion) VALUES (?, NOW(), ?, ?, ?)";
        $stmtInsert = $mysqli->prepare($sqlInsert);
        $estadoActual = 'RevisionComenzada';
        $stmtInsert->bind_param('ssii', $estadoActual, $usuario, $documento, $transaccion);
        $stmtInsert->execute();

        // Verificar si la consulta ha fallado
        if ($stmtInsert->error) {
            throw new Exception("Error al insertar en la tabla 'estados': " . $stmtInsert->error);
        }

        // Confirmar la transacción
        $mysqli->commit();

        // Redirigir a la página de comenzarRevision.php con un mensaje de alerta
        echo "<script>
            alert('Estado actualizado a \"revisionComenzada\" y registro guardado en la tabla \"estados\"');
            window.location.href = '../../views/revision.php?transaccion={$transaccion}&documento={$documento}';
        </script>";
    } catch (Exception $e) {
        // Si ocurre un error, revertir la transacción
        $mysqli->rollback();
        die($e->getMessage());
    }
} else {
    // Obtener los parámetros de la URL
    $transaccion = isset($_GET['transaccion']) ? $_GET['transaccion'] : '';
    $documento = isset($_GET['documento']) ? $_GET['documento'] : '';

    // Consulta SQL para obtener los datos de la tabla FacturasAgrupadas filtrando por transacción y documento
    $sql = "SELECT Id, StrUsuarioGra, DatFecha1, IntTransaccion, IntDocumento, Estado FROM Facturas WHERE IntTransaccion = ? AND IntDocumento = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $transaccion, $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {

    } else {
        echo "No se encontraron resultados para la transacción y documento seleccionados.";
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();
}
?>