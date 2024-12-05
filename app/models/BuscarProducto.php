<?php
// Importa la librería FPDF
require('C:/xampp/htdocs/pedidos/firma/fpdf/fpdf.php');

// Configuración de conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = 'Automuelles2024*';
$database = 'automuelles';

// Crear conexión
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Verificar si se envió la referencia mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['referencia'])) {
    $referencia = $_POST['referencia'];

    // Consulta para obtener el producto
    $sql = "SELECT * FROM productos WHERE referencia = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $referencia);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Crear el PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Detalles del Producto', 0, 1, 'C');
        $pdf->Ln(10);

        // Agregar información del producto
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'Referencia:', 0);
        $pdf->Cell(0, 10, $producto['referencia'], 0, 1);
        $pdf->Cell(50, 10, 'Nombre del Producto:', 0);
        $pdf->Cell(0, 10, $producto['nombre_producto'], 0, 1);
        $pdf->Cell(50, 10, 'Marca:', 0);
        $pdf->Cell(0, 10, $producto['marca'], 0, 1);
        $pdf->Cell(50, 10, 'Linea:', 0);
        $pdf->Cell(0, 10, $producto['linea'], 0, 1);
        $pdf->Cell(50, 10, 'Descripcion:', 0);
        $pdf->MultiCell(0, 10, $producto['descripcion_producto'], 0, 1);

        // Especificaciones Técnicas (formato JSON)
        if (!empty($producto['especificaciones'])) {
            $especificaciones = json_decode($producto['especificaciones'], true);
            $pdf->Cell(50, 10, 'Especificaciones Tecnicas:', 0, 1);
            foreach ($especificaciones as $especificacion) {
                $pdf->Cell(50, 10, ' - ' . $especificacion['titulo'] . ':', 0);
                $pdf->MultiCell(0, 10, $especificacion['descripcion'], 0, 1);
            }
        }

        // Cargar la imagen desde la ruta almacenada en la base de datos
        $imagePath = '../public/img/img Producto/' . $producto['imagen']; // Ruta completa a la imagen

        // Verificar si la imagen existe
        if (file_exists($imagePath)) {
            $pdf->Image($imagePath, 10, 40, 50); // Coloca la imagen en la posición (10,40) con ancho 50
        } else {
            $pdf->Cell(0, 10, 'Imagen no encontrada: ' . $producto['imagen'], 0, 1, 'C');
        }

        // Guardar el archivo PDF temporalmente
        $pdfPath = 'C:/xampp/htdocs/pedidos/temp/producto_' . $producto['referencia'] . '.pdf';
        $pdf->Output('F', $pdfPath); // Guardar en el sistema de archivos

        // Redirigir a crearbrochure.php
        header("Location: CrearBrochure.php");
        exit();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró el producto con la referencia proporcionada.'
        ]);
    }

    // Cerrar declaración y conexión
    $stmt->close();
    $mysqli->close();
}
?>