<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA y Utilidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Calculadora de IVA y Utilidad</h1>
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
</body>
</html>