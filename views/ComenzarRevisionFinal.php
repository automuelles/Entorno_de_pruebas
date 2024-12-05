<?php
include '../app/controllers/ComenzarRevisionFinal.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Transacción</th>
                        <th>Documento</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
    // Verificar si hay resultados
    if ($result && $result->num_rows > 0) {
        // Iterar sobre los resultados y generar las filas de la tabla
        while ($factura = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($factura['Id']); ?></td>
                        <td><?php echo htmlspecialchars($factura['StrUsuarioGra']); ?></td>
                        <td><?php echo htmlspecialchars($factura['DatFecha1']); ?></td>
                        <td><?php echo htmlspecialchars($factura['IntTransaccion']); ?></td>
                        <td><?php echo htmlspecialchars($factura['IntDocumento']); ?></td>
                        <td><?php echo htmlspecialchars($factura['Estado']); ?></td>
                    </tr>
                    <?php endwhile;
    } else {
        echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
    }
    ?>
                </tbody>
            </table>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex w-100">
                <form action="../app/controllers/ComenzarRevisionFinal.php" method="post" class="w-50 mr-2">
                    <input type="hidden" name="transaccion" value="<?php echo htmlspecialchars($transaccion); ?>">
                    <input type="hidden" name="documento" value="<?php echo htmlspecialchars($documento); ?>">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </form>
                <a href="./revision_final.php" class="btn btn-secondary btn-block w-50 ml-2">Volver</a>
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
            <a href="./revision_final.php" class="text-gray-500 text-center flex flex-col items-center">
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
                window.location.href = `./RevisionFinalFinalizada.php?transaccion=${encodeURIComponent(transaccion)}&documento=${encodeURIComponent(documento)}`;
            }
        }
    </script>
</body>

</html>