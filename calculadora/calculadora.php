<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Calculadora de IVA</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="valor" class="form-label">Ingrese el valor del producto:</label>
                        <input type="number" name="valor" id="valor" class="form-control" placeholder="Ejemplo: 1000" required>
                    </div>
                    <button type="submit" name="calcular_iva" class="btn btn-primary w-100">Calcular IVA</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular_iva'])) {
                    // Obtener el valor ingresado
                    $valor = floatval($_POST['valor']);

                    // Calcular el IVA
                    $iva = $valor * 0.19;
                    $total = $valor + $iva;

                    // Mostrar resultados
                    echo "<div class='alert alert-success mt-4' role='alert'>";
                    echo "<strong>Resultados:</strong><br>";
                    echo "Valor sin IVA: $" . number_format($valor, 2) . "<br>";
                    echo "IVA (19%): $" . number_format($iva, 2) . "<br>";
                    echo "Total con IVA: $" . number_format($total, 2);
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>