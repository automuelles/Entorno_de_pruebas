<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = 'Automuelles2024*';
$database = 'automuelles';

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = ""; // Variable para el mensaje

// Manejar solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $newPassword = trim($_POST["new_password"]);
    $confirmPassword = trim($_POST["confirm_password"]);

    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        $mensaje = "Por favor completa todos los campos.";
    } elseif ($newPassword !== $confirmPassword) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el correo existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Encriptar la nueva contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $updateStmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
            if (!$updateStmt) {
                die("Error en la preparación de la consulta: " . $conn->error);
            }

            $updateStmt->bind_param("ss", $hashedPassword, $email);

            if ($updateStmt->execute()) {
                $mensaje = "La contraseña se cambió con éxito.";
            } else {
                $mensaje = "Error al actualizar la contraseña.";
            }

            $updateStmt->close();
        } else {
            $mensaje = "El correo no está registrado.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>
    <!-- Incluyendo Tailwind CSS desde la CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Recuperación de Contraseña</h2>
        <form method="post" action="">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Correo Electrónico:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    class="mt-1 w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-600">Nueva Contraseña:</label>
                <input 
                    type="password" 
                    id="new_password" 
                    name="new_password" 
                    required 
                    class="mt-1 w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div class="mb-6">
                <label for="confirm_password" class="block text-sm font-medium text-gray-600">Confirmar Contraseña:</label>
                <input 
                    type="password" 
                    id="confirm_password" 
                    name="confirm_password" 
                    required 
                    class="mt-1 w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Actualizar Contraseña
            </button>
        </form>
    </div>

    <!-- Mostrar el mensaje en una alerta -->
    <?php if (!empty($mensaje)): ?>
        <script>
            alert("<?= $mensaje ?>");
        </script>
    <?php endif; ?>

    <!-- Footer Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-lg">
        <div class="flex justify-around py-2">
            <a href="../index.php" class="text-gray-500 text-center flex flex-col items-center hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16l4-4m0 0l-4-4m4 4H9" />
                </svg>
                <span class="text-xs">Volver</span>
            </a>
        </div>
    </nav>
</body>
</html>