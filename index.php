<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sign in | up Form</title>

    <!-- add style css -->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">

</head>

<body>
    <h2>Iniciar sesión | Registrarse</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
        <form action="php_register.php" method="post">
    <h1>Crear una cuenta</h1>
    <div class="social-container">
        <a href="#" class="social">
            <i class="fa fa-facebook"></i>
        </a>
        <a href="#" class="social">
            <i class="fa fa-youtube-play"></i>
        </a>
        <a href="#" class="social">
            <i class="fa fa-linkedin"></i>
        </a>
    </div>
    <span>o utiliza tu correo electrónico para registrarte</span>
    <input type="text" name="name" placeholder="Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <button type="submit">Inscribirse</button>
</form>
        </div>
        <div class="form-container sign-in-container">
            <form action="php_login.php" method="post">
                <!-- Cambia la ruta según la ubicación de tu archivo -->
                <h1>Inscribirse</h1>
                <div class="social-container">
                    <a href="#" class="social">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="social">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                    <a href="#" class="social">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </div>
                <span>o usa tu cuenta</span>
                <input type="email" name="email" placeholder="Email" required />
            
                <input type="password" name="password" placeholder="Password" required />
                <a href="./views/RecuperarContraseña.php">¿Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>
                        Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
                    <button class="ghost" id="signIn">Iniciar sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Bienvenido al Registro!</h1>
                    <p>
                        Introduce tus datos personales y comienza el viaje con nosotros</p>
                    <button class="ghost" id="signUp">Inscribirse</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>
            <a target="_blank" href="#">Automuelles Diesel</a>
        </p>
    </footer>

    <!-- add style js -->
    <script type="text/javascript" src="./assets/js/internal.js"></script>

</body>

</html>