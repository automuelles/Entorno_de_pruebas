<?php
session_start();

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

// Obtener los parámetros de la solicitud AJAX
$transaccion = isset($_GET['transaccion']) ? $_GET['transaccion'] : '';
$documento = isset($_GET['documento']) ? $_GET['documento'] : '';

// Validar que los parámetros no estén vacíos
if (empty($transaccion) || empty($documento)) {
    die("Error: faltan parámetros.");
}

// Consulta SQL para obtener los detalles
$query = "
SELECT 
    d.IntTransaccion, 
    d.IntDocumento, 
    d.StrProducto, 
    p.StrParam1, 
    d.IntCantidad, 
    d.StrUnidad
FROM TblDetalleDocumentos d
LEFT JOIN TblProductos p ON d.StrProducto = p.StrIdProducto
LEFT JOIN TblDocumentos doc ON d.IntTransaccion = doc.IntTransaccion AND d.IntDocumento = doc.IntDocumento
WHERE 
    d.IntTransaccion = :transaccion AND 
    d.IntDocumento = :documento
ORDER BY d.IntDocumento";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':transaccion', $transaccion, PDO::PARAM_INT);
    $stmt->bindParam(':documento', $documento, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar un array para agrupar los resultados por producto
    $agrupados = [];

    // Recorrer los resultados y agrupar por producto
    foreach ($results as $row) {
        $producto = $row['StrProducto'];
        if (!isset($agrupados[$producto])) {
            // Si no existe el producto en el array, inicializarlo
            $agrupados[$producto] = [
                'Producto' => $producto,
                'Parámetros' => [],
                'Cantidades' => [],
                'Unidades' => $row['StrUnidad']
            ];
        }

        // Agrupar parámetros y cantidades
        $agrupados[$producto]['Parámetros'][] = $row['StrParam1'];
        // Formatear las cantidades con 2 decimales
        $agrupados[$producto]['Cantidades'][] = number_format($row['IntCantidad'], 2);
    }

    // Verificar si hay resultados
    if ($agrupados) {
        // Imprimir los resultados agrupados
        foreach ($agrupados as $producto => $detalles) {
            echo '<div class="modal-item">';
            echo '<input type="checkbox" id="opcion1"><label for="opcion1"></label>';
            echo '<h5>Producto: </h5>' . htmlspecialchars($detalles['Producto']);
            echo '<h5>Parámetros: </h5>' . htmlspecialchars(implode(', ', $detalles['Parámetros']));
            echo '<h5>Cantidades: </h5>' . htmlspecialchars(implode(', ', $detalles['Cantidades']));
            echo '<h5>Unidad: </h5>' . htmlspecialchars($detalles['Unidades']);
            echo '<hr>'; // Separador entre productos
            echo '</div>';
        }
    } else {
        echo '<p>No se encontraron resultados.</p>';
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Cerrar la conexión
$conn = null; 
?>