<?php
// Conexión a la base de datos MySQL automuelles
$host = 'localhost';
$user = 'root';
$password = 'Automuelles2024*';
$database = 'automuelles';

// Crear una nueva conexión a la base de datos MySQL
$mysqli = new mysqli($host, $user, $password, $database);

// Verificar si hay algún error en la conexión
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Consulta SQL para seleccionar todos los registros de la tabla Facturas con el estado 'RevisionFinalFinalizada'
$sql = "SELECT * FROM Facturas WHERE StrUsuarioGra IS NOT NULL AND Estado = 'RevisionFinalFinalizada'";
$result = $mysqli->query($sql);

// Verificar si la consulta ha fallado
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}

// Crear un array para almacenar los resultados
$facturas = [];

// Recorrer los resultados
while ($row = $result->fetch_assoc()) {
    $facturas[] = [
        'IntTransaccion' => $row['IntTransaccion'],
        'IntDocumento' => $row['IntDocumento'],
        'StrUsuarioGra' => isset($row['StrUsuarioGra']) ? $row['StrUsuarioGra'] : 'Desconocido',  // Si no existe, usar 'Desconocido'
        'DatFecha1' => isset($row['DatFecha1']) ? $row['DatFecha1'] : 'Fecha no disponible'  // Si no existe, usar un valor por defecto
    ];
}
// Cerrar la conexión a MySQL
$mysqli->close();

// Conexión a SQL Server AutomuellesDiesel1
$serverName = "SERVAUTOMUELLES\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "AutomuellesDiesel1",
    "Uid" => "AutomuellesDiesel",
    "PWD" => "Complex@2024Pass!"
);

try {
    // Crear conexión PDO a SQL Server
    $conn = new PDO("sqlsrv:server=$serverName;Database=AutomuellesDiesel1", $connectionOptions["Uid"], $connectionOptions["PWD"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta SQL para obtener detalles desde AutomuellesDiesel1
$query = "
    SELECT 
        d.IntTransaccion, 
        d.IntDocumento, 
        d.StrReferencia1, 
        d.StrReferencia3
    FROM TblDocumentos d
    WHERE d.IntTransaccion = :transaccion AND d.IntDocumento = :documento
    AND d.StrReferencia1 IS NOT NULL AND d.StrReferencia3 IS NOT NULL
    ORDER BY d.IntDocumento";

// Preparar la consulta SQL
$stmt = $conn->prepare($query);

// Procesar cada factura obtenida de 'automuelles'
$facturasConReferencias = [];
foreach ($facturas as $factura) {
    // Ejecutar la consulta para cada factura
    $stmt->execute([
        ':transaccion' => $factura['IntTransaccion'],
        ':documento' => $factura['IntDocumento'],
    ]);

    // Obtener los resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($resultado) {
        // Si hay resultados, agruparlos
        $facturasConReferencias = array_merge($facturasConReferencias, $resultado);
    }
}

// Cerrar la conexión a SQL Server
$conn = null;
?>
