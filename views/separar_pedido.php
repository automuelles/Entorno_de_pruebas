<?php
session_start(); // Inicia la sesión

if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
   
}
include '../app/controllers/separar_pedido.php';
include '../app/models/includes/Guardar_Facturas.php'; 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Pagina Bodega Automuelles</title>
    <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <p class="text-gray-600 text-sm">Area de Pedidos Pendientes</p>
    </div>

    <!-- Features Section -->
    <div class="w-full max-w-xs">
        <h2 class="text-center text-lg font-semibold text-gray-700 mb-4">Pedidos Pendientes</h2>
        <div class="container mt-4">
            <?php foreach ($data as $key => $group) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Transacción: <?php echo htmlspecialchars($group['IntTransaccion']); ?> | Factura:
                        <?php echo htmlspecialchars($group['IntDocumento']); ?></h5>
                    <button class="btn btn-primary btn-block"
                        onclick="confirmSepararPedido('<?php echo htmlspecialchars($group['IntTransaccion']); ?>', '<?php echo htmlspecialchars($group['IntDocumento']); ?>')">Separar
                        Pedido</button>
                </div>
                <div class="card-body">
                    <p><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($group['FechaRegistro']); ?></p>
                    <p><strong>Creado Por:</strong> <?php echo htmlspecialchars($group['StrUsuarioGra']); ?></p>

                    <!-- Hacer la tabla desplazable en pantallas pequeñas -->
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th># Transaccion</th>
                                    <th># Documento</th>
                                    <th>Fecha</th>
                                    <th>Vendedor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($group['Detalles'] as $index => $detalle) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($detalle['IntTransaccion']); ?></td>
                                    <td><?php echo htmlspecialchars($detalle['IntDocumento'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($detalle['DatFecha1']); ?></td>
                                    <td><?php echo htmlspecialchars($detalle['StrUsuarioGra']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
            <a href="./Bodega_Principal.php" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs">Volver</span>
            </a>
            <a href="#" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-xs">Paginas</span>
            </a>
            <a href="#" class="text-gray-500 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-xs">Apps</span>
            </a>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmSepararPedido(transaccion, documento) {
            if (confirm('¿Está seguro de que desea separar el pedido?')) {
                // Redirigir a la página separarpedido.php con los parámetros necesarios
                window.location.href = `./picking.php?transaccion=${encodeURIComponent(transaccion)}&documento=${encodeURIComponent(documento)}`;
            }
        }
    </script>
</body>

</html>