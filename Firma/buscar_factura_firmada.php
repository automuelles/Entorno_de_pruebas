<?php
session_start();
require_once('fpdf/fpdf.php');

function obtenerNombreDeUsuario()
{
    return isset($_SESSION['usuario']) ? strtoupper($_SESSION['usuario']) : "ADMIN";
}

// Función para buscar la factura firmada en la base de datos
function buscarFacturaFirmada($numeroFactura)
{
    // Configuración de la conexión a la base de datos
    $host = 'localhost';
    $user = 'root';
    $password = 'Automuelles2024*';
    $database = 'automuelles';

    try {
        // Crear la conexión
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("SELECT pdf FROM facturas_firmadas WHERE numero_factura = :numero_factura");
        $stmt->bindParam(':numero_factura', $numeroFactura);
        $stmt->execute();

        // Verificar si se encontró la factura
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['pdf'];
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Factura Firmada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
    .neumorphism {
        background: #e0e5ec;
        border-radius: 15px;
        box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
    }

    .neumorphism-icon {
        box-shadow: 6px 6px 12px #bebebe, -6px -6px 12px #ffffff;
    }
    </style>
</head>

<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-center">
    <div class="neumorphism w-full max-w-xs p-6 text-center mb-6">
        <h1 class="text-blue-600 text-2xl font-bold">Bienvenido to Automuelles</h1>
        <?php
        if (isset($_SESSION['usuario'])) {
            echo htmlspecialchars($_SESSION['usuario']); // Muestra el nombre del usuario
        } else {
            echo "Usuario"; 
        }
        ?>
        <p class="text-gray-600 text-sm">Pagina de busqueda de facturas firmadas</p>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-center">Buscar Factura Firmada</h3>
                <form id="buscarFacturaForm" method="post" action="">
                    <div class="mb-3">
                        <label for="numeroFactura" class="form-label">Número de Factura</label>
                        <input type="text" class="form-control" name="numeroFactura" id="numeroFactura"
                            aria-describedby="facturaHelp">
                        <div id="facturaHelp" class="form-text">Ingresa el número de la factura (ejemplo: 40-15300).
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $numeroFactura = $_POST['numeroFactura'];
                    $pdfBase64 = buscarFacturaFirmada($numeroFactura);

                    if ($pdfBase64) {
                        echo '
                        <div class="mt-4">
                            <h5>Factura Firmada:</h5>
                            <iframe src="data:application/pdf;base64,' . $pdfBase64 . '" width="100%" height="500px"></iframe>
                        </div>';
                    } else {
                        echo '<div class="mt-4 alert alert-danger" role="alert">Factura no encontrada.</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-lg">
        <div class="flex justify-around py-2">
            <a href="../index.php" class="text-blue-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs">Salir</span>
            </a>
            <a href="./Firma.php" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs">volver</span>
            </a>
        </div>
        <nav>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>