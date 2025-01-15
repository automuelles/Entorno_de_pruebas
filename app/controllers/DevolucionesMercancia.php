<?php
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

// Consulta SQL para seleccionar todos los registros de la tabla FacturasAgrupadas
$sql = "SELECT * FROM Notas WHERE StrUsuarioGra IS NOT NULL AND Estado = 'pendiente'"; // Filtrar los registros como consideres necesario
$result = $mysqli->query($sql);

// Verificar si la consulta ha fallado
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}

// Crear un array para agrupar los datos
$data = [];

// Recorrer los resultados y agruparlos
while ($row = $result->fetch_assoc()) {
    $key = $row['IntTransaccion'] . '-' . $row['IntDocumento'];
    
    if (!isset($data[$key])) {
        $data[$key] = [
            'IntTransaccion' => $row['IntTransaccion'],
            'IntDocumento' => $row['IntDocumento'],
            'FechaRegistro' => $row['DatFecha1'], 
            'StrUsuarioGra' => $row['StrUsuarioGra'], 
            'Detalles' => []
        ];
    }
    
    // Agregar detalles, si los tienes. Aquí no hay JSON, pero puedes modificarlo si hay más información.
    $data[$key]['Detalles'][] = $row; // Aquí puedes personalizar qué detalles agregar
}

$mysqli->close();
?>