<?php
session_start(); // Inicia la sesión

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

// Inicializa la variable $autenticado
$autenticado = false;

// Procesar el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar el usuario
    $stmt = $conn->prepare("SELECT nombre_usuario, password FROM usuarios WHERE email = ?");
    
    // Verificar si la preparación fue exitosa
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si existe el usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombreUsuario, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            $_SESSION['usuario'] = $nombreUsuario; // Guarda el nombre de usuario en la sesión
            $autenticado = true; // Establece la variable $autenticado como verdadera
            header("Location: ./views/paginaPrincipal.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No existe un usuario con ese correo.";
    }

    $stmt->close();
}

$conn->close();
?>