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

// Consulta SQL para seleccionar facturas con estado 'RevisionFinalFinalizada'
$sql = "SELECT IntTransaccion, IntDocumento, StrUsuarioGra, DatFecha1 
        FROM Facturas 
        WHERE StrUsuarioGra IS NOT NULL 
          AND Estado = 'RevisionDespachosFinalizada'";
$result = $mysqli->query($sql);

// Verificar si la consulta ha fallado
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}

// Crear un array para almacenar los resultados
$facturas = [];
while ($row = $result->fetch_assoc()) {
    $facturas[] = [
        'IntTransaccion' => $row['IntTransaccion'],
        'IntDocumento' => $row['IntDocumento'],
        'StrUsuarioGra' => $row['StrUsuarioGra'] ?? 'Desconocido',
        'DatFecha1' => $row['DatFecha1'] ?? 'Fecha no disponible'
    ];
}
$mysqli->close();

// Conexión a SQL Server AutomuellesDiesel1
$serverName = "SERVAUTOMUELLES\SQLEXPRESS";
$connectionOptions = [
    "Database" => "AutomuellesDiesel1",
    "Uid" => "AutomuellesDiesel",
    "PWD" => "Complex@2024Pass!"
];

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=AutomuellesDiesel1", $connectionOptions["Uid"], $connectionOptions["PWD"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta SQL para obtener detalles de TblDocumentos
$query = "
    SELECT 
        d.IntTransaccion, 
        d.IntDocumento, 
        d.StrReferencia1, 
        d.StrReferencia3
    FROM TblDocumentos d
    WHERE d.IntTransaccion = :transaccion 
      AND d.IntDocumento = :documento
      AND d.StrReferencia1 IS NOT NULL 
      AND d.StrReferencia1 != '' 
      AND d.StrReferencia1 != '0'
      AND d.StrReferencia3 IS NOT NULL 
      AND d.StrReferencia3 != '' 
      AND d.StrReferencia3 != '0'";

$stmt = $conn->prepare($query);

// Procesar cada factura obtenida de 'automuelles'
$facturasConReferencias = [];
foreach ($facturas as $factura) {
    $stmt->execute([
        ':transaccion' => $factura['IntTransaccion'],
        ':documento' => $factura['IntDocumento'],
    ]);
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($resultado) {
        foreach ($resultado as $row) {
            $facturasConReferencias[] = $row;
        }
    }
}
$conn = null;
?>
