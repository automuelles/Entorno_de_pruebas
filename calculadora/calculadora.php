<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA y Utilidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
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
        <p class="text-gray-600 text-sm">Calculadora</p>
    </div>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="valor" class="form-label">Ingrese el valor del producto:</label>
                        <input type="number" name="valor" id="valor" class="form-control" placeholder="Ejemplo: 1000" required>
                    </div>
                    <div class="mb-3">
                        <label for="utilidad" class="form-label">Ingrese el porcentaje de utilidad (%):</label>
                        <input type="number" name="utilidad" id="utilidad" class="form-control" placeholder="Ejemplo: 20" required>
                    </div>
                    <button type="submit" name="calcular" class="btn btn-primary w-100">Calcular</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular'])) {
                    // Obtener los valores ingresados
                    $valor = floatval($_POST['valor']);
                    $utilidad_porcentaje = floatval($_POST['utilidad']);

                    // Calcular el IVA
                    $iva = $valor * 0.19;
                    $valor_con_iva = $valor + $iva;

                    // Calcular la utilidad
                    $utilidad = $valor * ($utilidad_porcentaje / 100);
                    $total_con_utilidad = $valor_con_iva + $utilidad;

                    // Mostrar resultados
                    echo "<div class='alert alert-success mt-4' role='alert'>";
                    echo "<strong>Resultados:</strong><br>";
                    echo "Valor sin IVA: $" . number_format($valor, 2) . "<br>";
                    echo "IVA (19%): $" . number_format($iva, 2) . "<br>";
                    echo "Valor con IVA: $" . number_format($valor_con_iva, 2) . "<br>";
                    echo "Utilidad ({$utilidad_porcentaje}%): $" . number_format($utilidad, 2) . "<br>";
                    echo "Total con IVA y Utilidad: $" . number_format($total_con_utilidad, 2);
                    echo "</div>";
                }
                ?>
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
            <a href="../views/vendedor_principal.php" class="text-gray-500 text-center flex flex-col items-center">
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
</body>
</html>