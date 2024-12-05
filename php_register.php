<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "Automuelles2024*";
$dbname = "automuelles";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario incluyendo nombre_usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (email, password, nombre_usuario) VALUES (?, ?, ?)"); 
    // Verificar si la preparación fue exitosa
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Usamos una cadena vacía para nombre_usuario
    $nombre_usuario = ''; // Valor vacío para nombre_usuario
    $stmt->bind_param("sss", $email, $hashed_password, $nombre_usuario);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
        header("Location: ./views/paginaprincipal.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>