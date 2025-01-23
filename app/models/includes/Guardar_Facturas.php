<?php
// Establecer la zona horaria
date_default_timezone_set('America/Bogota');

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = $_SESSION['usuario'];

// Lógica de conexión y consulta
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

// Conexión a SQL Server
$serverName = "SERVAUTOMUELLES\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "AutomuellesDiesel1",
    "Uid" => "AutomuellesDiesel",
    "PWD" => "Complex@2024Pass!"
);

// Establecer conexión con PDO
try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=AutomuellesDiesel1", $connectionOptions["Uid"], $connectionOptions["PWD"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta para obtener solo las facturas
$query = "
SELECT 
    d.IntTransaccion, 
    d.IntDocumento, 
    d.StrProducto, 
    p.StrParam1, 
    d.IntCantidad, 
    d.StrUnidad, 
    d.DatFecha1, 
    d.StrVendedor,
    doc.StrUsuarioGra, 
    doc.StrReferencia1,
    doc.StrReferencia3, 
    doc.IntTotal
FROM TblDetalleDocumentos d
LEFT JOIN TblProductos p ON d.StrProducto = p.StrIdProducto
LEFT JOIN TblDocumentos doc ON d.IntTransaccion = doc.IntTransaccion AND d.IntDocumento = doc.IntDocumento
WHERE CONVERT(DATE, d.DatFecha1) = CONVERT(DATE, GETDATE())
AND d.IntTransaccion IN (40, 42, 88, 90)
ORDER BY d.IntDocumento";
$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar facturas por IntDocumento
$facturasAgrupadas = [];
foreach ($results as $row) {
    $facturasAgrupadas[$row['IntDocumento']][] = $row;
}

// Guardar los datos en MySQL si $facturasAgrupadas no está vacío
if (!empty($facturasAgrupadas)) {
    foreach ($facturasAgrupadas as $documento => $facturas) {
        foreach ($facturas as $factura) {
            // Verificar que IntDocumento no contenga el símbolo "-" y que el registro no exista
            if (strpos($factura['IntDocumento'], '-') === false) {
                // Verificar si el registro ya existe
                $sql_check = "SELECT COUNT(*) FROM Facturas WHERE IntDocumento = ? AND IntTransaccion = ?";
                $stmt_check = $mysqli->prepare($sql_check);
                $stmt_check->bind_param("si", $factura['IntDocumento'], $factura['IntTransaccion']);
                $stmt_check->execute();
                $stmt_check->bind_result($count);
                $stmt_check->fetch();
                $stmt_check->close();
                
                // Solo insertar si no existe
                if ($count == 0) {
                    $sql_insert = "
                    INSERT INTO Facturas (StrUsuarioGra, DatFecha1, IntTransaccion, IntDocumento)
                    VALUES (?, ?, ?, ?)";
                    
                    $stmt_insert = $mysqli->prepare($sql_insert);
                    
                    // Obtener fecha y hora actuales
                    $currentDateTime = date('Y-m-d H:i:s');
                    $stmt_insert->bind_param("ssii", $factura['StrUsuarioGra'], $currentDateTime, $factura['IntTransaccion'], $factura['IntDocumento']);
                    
                    try {
                        $stmt_insert->execute();
                    } catch (mysqli_sql_exception $e) {
                        // Manejo de errores en la inserción
                        // Aquí puedes manejar errores, pero evita imprimir o mostrar información al usuario
                    }
                }
            }
        }
    }
}
// Consultar el número de facturas pendientes
$sqlPendientes = "SELECT COUNT(*) AS totalPendientes FROM Facturas WHERE Estado = 'Pendiente'";
$resultPendientes = $mysqli->query($sqlPendientes);

if ($resultPendientes) {
    $totalPendientes = $resultPendientes->fetch_assoc()['totalPendientes'];

    // Mostrar el ícono de campana y el número de facturas pendientes
    echo "
    <div style='display: flex; align-items: center;'>
        <i class='fa fa-bell' style='font-size: 30px; margin-right: 10px; color: #f39c12;'></i>
        <span style='font-size: 20px; font-weight: bold;'>$totalPendientes</span>
    </div>";

    // Reproducir el audio mediante JavaScript
    echo "
    <script>
        const audio = new Audio('../../../public/audio/audio.mp3'); // Usar ruta absoluta desde el servidor
        audio.play().catch(function(error) {
            console.log('Error al reproducir el audio: ' + error);
        });
    </script>";
} else {
    // Si ocurre un error, muestra un valor predeterminado
    echo "0";
}
// Cerrar la conexión a la base de datos
$mysqli->close();
$conn = null; // Cerrar conexión PDO
?>
<!-- Agregar enlace para cargar Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">