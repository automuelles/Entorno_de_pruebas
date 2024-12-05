<?php
include '../app/controllers/finalizarRevisionDespachos.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Bodega Automuelles</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    /* Estilo para asegurar que el modal ocupe toda la pantalla en celulares */
    @media (max-width: 576px) {
        .modal-dialog {
            max-width: 100%;
            margin: 0;
        }

        .modal-content {
            height: 100vh;
            /* Ocupa la altura total de la pantalla */
            border-radius: 0;
            overflow-y: auto;
            /* Agrega scroll si el contenido es demasiado */
        }
    }

    .details-list {
        list-style-type: none;
        /* Elimina los puntos de la lista */
        padding: 0;
        /* Elimina el padding por defecto */
        margin: 0;
        /* Elimina el margin por defecto */
    }

    .details-list li {
        padding: 10px 0;
        /* Espaciado vertical entre elementos */
        border-bottom: 1px solid #ddd;
        /* Línea separadora */
        display: flex;
        /* Asegura que el texto en negrita y el contenido se alineen bien */
        justify-content: space-between;
        /* Distribuye el espacio entre elementos */
    }

    .details-list li:last-child {
        border-bottom: none;
        /* Elimina la línea de la última fila */
    }

    .details-list strong {
        flex: 1;
        /* Ocupa el espacio disponible */
        margin-right: 10px;
        /* Espacio entre el texto en negrita y el contenido */
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
        <h1 class="h3">Detalles de la Factura</h1>
        <p><strong>Transacción:</strong> <?php echo htmlspecialchars($transaccion); ?></p>
        <p><strong>Documento:</strong> <?php echo htmlspecialchars($documento); ?></p>

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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($factura = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($factura['Id']); ?></td>
                        <td><?php echo htmlspecialchars($factura['StrUsuarioGra']); ?></td>
                        <td><?php echo htmlspecialchars($factura['DatFecha1']); ?></td>
                        <td><?php echo htmlspecialchars($factura['IntTransaccion']); ?></td>
                        <td><?php echo htmlspecialchars($factura['IntDocumento']); ?></td>
                        <td><?php echo htmlspecialchars($factura['Estado']); ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#modalFactura"
                                data-transaccion="<?php echo htmlspecialchars($factura['IntTransaccion']); ?>"
                                data-documento="<?php echo htmlspecialchars($factura['IntDocumento']); ?>">
                                Ver
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
            <form action="" method="post" class="w-100 w-md-auto mb-2 mb-md-0">
                <input type="hidden" name="transaccion" value="<?php echo htmlspecialchars($transaccion); ?>">
                <input type="hidden" name="documento" value="<?php echo htmlspecialchars($documento); ?>">
                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFactura" tabindex="-1" role="dialog" aria-labelledby="modalFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFacturaLabel">Detalles de la Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalFacturaBody">
                    <ul class="details-list">
                        <li><strong>Producto:</strong> <span id="producto"></span></li>
                        <li><strong>Ubicación:</strong> <span id="parametro"></span></li>
                        <li><strong>Cantidad:</strong> <span id="cantidad"></span></li>
                        <li><strong>Unidad:</strong> <span id="unidad"></span></li>
                        <li><strong>Fecha:</strong> <span id="fecha"></span></li>
                        <li><strong>Vendedor:</strong> <span id="vendedor"></span></li>
                        <li><strong>Nombre Usuario:</strong> <span id="usuario"></span></li>
                        <li><strong>Datos de entrega:</strong> <span id="referencia1"></span></li>
                        <li><strong>Método de Pago:</strong> <span id="referencia3"></span></li>
                        <li><strong>Valor:</strong> <span id="valor"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#modalFactura').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var transaccion = button.data('transaccion'); // Extract info from data-* attributes
            var documento = button.data('documento');

            // Perform AJAX request to fetch invoice details
            $.ajax({
                url: '../app/controllers/Obtener_Detalles.php',
                method: 'GET',
                data: {
                    transaccion: transaccion,
                    documento: documento
                },
                success: function(response) {
                    // Update modal content here
                    $('#modalFacturaBody').html(response);
                },
                error: function() {
                    $('#modalFacturaBody').html('<p>Error retrieving data.</p>');
                }
            });
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>