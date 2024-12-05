<?php
session_start(); // Inicia la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal Automuelles</title>
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
        <p class="text-gray-600 text-sm">Pagina Principal</p>
    </div>

    <!-- Features Section -->
    <div class="w-full max-w-xs">
        <h2 class="text-center text-lg font-semibold text-gray-700 mb-4">Modulos</h2>
        <div class="grid grid-cols-3 gap-4">
            <div class="neumorphism p-4 text-center">
                <!-- Icono de vendedor -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-yellow-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-user text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="vendedor_principal.php" class="text-sm text-gray-700 hover:underline">Vendedor</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono de Bodega -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-orange-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-shop text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="Bodega_principal.php" class="text-sm text-gray-700 hover:underline">Bodega</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono de Bodega -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-green-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-motorcycle text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="#" class="text-sm text-gray-700 hover:underline">Mensajero</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono de Bodega -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-red-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-lock text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="./Admin.php" class="text-sm text-gray-700 hover:underline">Admin</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono de Bodega -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-purple-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-car text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="./despachos_Principal.php" class="text-sm text-gray-700 hover:underline">Despachos</a>
            </div>
            <div class="neumorphism p-4 text-center">
                <!-- Icono de Bodega -->
                <div
                    class="neumorphism-icon w-10 h-10 bg-purple-400 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-car text-white"></i>
                </div>
                <!-- Etiqueta como enlace -->
                <a href="./BaseArchivos.php" class="text-sm text-gray-700 hover:underline">Base Archivos</a>
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
            <a href="../Firma/Firma.php" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-xs">Firma Facturas</span>
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