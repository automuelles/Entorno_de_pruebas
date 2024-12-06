<?php
session_start(); // Inicia la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
}

// Conexión a la base de datos
$host = 'localhost';
$db = 'automuelles';
$user = 'root';
$pass = 'Automuelles2024*';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Recuperar el nombre de usuario desde la sesión
$nombre_usuario = $_SESSION['usuario']; // Se asume que 'usuario' está en la sesión

// Consultar el rol del usuario en la base de datos
$sql = "SELECT rol FROM usuarios WHERE nombre_usuario = :nombre_usuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nombre_usuario', $nombre_usuario);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si el rol es válido
if (!$usuario || !in_array($usuario['rol'], ['Admin', 'Vendedor'])) {
    // Si el rol no es Admin o Bodega, redirige a la página principal
    header("Location: paginaPrincipal.php");
    exit();
}

// Incluye el archivo Guardar_Facturas.php si el usuario tiene el rol adecuado
include '../app/models/includes/Guardar_Facturas.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Despachos Automuelles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Neumorphism effect */
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
    <!-- Header -->
    <div class="neumorphism w-full max-w-xs p-6 text-center mb-6">
        <h1 class="text-blue-600 text-2xl font-bold">Bienvenido to Automuelles</h1>
        <?php
        if (isset($_SESSION['usuario'])) {
            echo htmlspecialchars($_SESSION['usuario']); // Muestra el nombre del usuario
        } else {
            echo "Usuario"; 
        }
        ?>
        <p class="text-gray-600 text-sm">Area de administracion</p>
    </div>

    <!-- Features Section -->
    <div class="w-full max-w-xs">
        <h2 class="text-center text-lg font-semibold text-gray-700 mb-4">Modulos</h2>
        <div class="grid grid-cols-3 gap-4">
            <div class="neumorphism p-4 text-center">
                <!-- Icono -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-green-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-check text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Ubicacion Mensajeros</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono-->
                <div
                    class="neumorphism-icon w-10 h-10 bg-purple-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass-dollar text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Historial Entregas</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono-->
                <div
                    class="neumorphism-icon w-10 h-10 bg-red-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-circle-exclamation text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Consolidado Mes</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono-->
                <div
                    class="neumorphism-icon w-10 h-10 bg-blue-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-circle-exclamation text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Consultar  Stock</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono-->
                <div
                    class="neumorphism-icon w-10 h-10 bg-yellow-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-circle-exclamation text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Cotizaciones</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <div class="neumorphism-icon w-10 h-10 bg-blue-400 rounded-full mx-auto mb-2"></div>
                <p class="text-sm text-gray-700">#</p>
            </div>
        </div>
    </div>

      <!-- Footer Navigation -->
      <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-lg">
        <div class="flex justify-around py-2">
            <a href="../index.php" class="text-blue-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs">Salir</span>
            </a>
            <a href="./paginaPrincipal.php" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs">Volver</span>
            </a>
            <a href="#" id="openModal" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-xs">Apps</span>
            </a>
        </div>
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
                <!-- Contenido del modal -->
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">apps</h2>
                    <p class="mt-2 text-gray-600">apps integradas</p>
                </div>
                <!-- Footer del modal -->
                <div class="flex justify-end p-4 border-t">
                    <button id="closeModal"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Cerrar</button>
                </div>
            </div>
        </div>
    </nav>
    <script>
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('modal');

    // Abrir el modal
    openModal.addEventListener('click', (event) => {
        event.preventDefault(); // Prevenir navegación del enlace
        modal.classList.remove('hidden');
    });

    // Cerrar el modal
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Cerrar el modal al hacer clic fuera del contenido
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
    </script>
</body>

</html>