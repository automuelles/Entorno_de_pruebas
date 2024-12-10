<?php
session_start(); // Inicia la sesión
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
}
include '../app/models/includes/Guardar_Facturas.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Despachos Automuelles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <p class="text-gray-600 text-sm">Ingreso de Prodcutos</p>
    </div>
    <main class="min-h-screen flex flex-col items-center justify-start bg-gray-100">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md flex flex-col justify-between h-full">
        <h2 class="text-2xl font-bold mb-4">Registro de Producto</h2>
        <form action="../app/models/Formulario_Guardar_Producto.php" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
            <!-- Referencia -->
            <div class="mb-4">
                <label for="referencia" class="block text-gray-700 font-semibold">Referencia:</label>
                <input type="text" id="referencia" name="referencia" class="w-full p-2 border rounded" required>
            </div>

            <!-- Nombre del Producto -->
            <div class="mb-4">
                <label for="nombre_producto" class="block text-gray-700 font-semibold">Nombre del
                    Producto:</label>
                <input type="text" id="nombre_producto" name="nombre_producto" class="w-full p-2 border rounded"
                    required>
            </div>

            <!-- Marca -->
            <div class="mb-4">
                <label for="marca" class="block text-gray-700 font-semibold">Marca:</label>
                <input type="text" id="marca" name="marca" class="w-full p-2 border rounded">
            </div>

            <!-- Línea -->
            <div class="mb-4">
                <label for="linea" class="block text-gray-700 font-semibold">Línea:</label>
                <input type="text" id="linea" name="linea" class="w-full p-2 border rounded">
            </div>

            <!-- Descripción del Producto -->
            <div class="mb-4">
                <label for="descripcion_producto" class="block text-gray-700 font-semibold">Descripción del
                    Producto:</label>
                <textarea id="descripcion_producto" name="descripcion_producto"
                    class="w-full p-2 border rounded" rows="4"></textarea>
            </div>

            <!-- Especificaciones Técnicas -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Especificaciones Técnicas:</label>
                <div id="especificacionesContainer">
                    <!-- Espacio para especificaciones adicionales -->
                </div>
                <button type="button" onclick="agregarEspecificacion()"
                    class="mt-2 bg-blue-500 text-white px-3 py-1 rounded">Agregar Especificación</button>
            </div>

            <!-- Imagen -->
            <div class="mb-4">
                <label for="imagen" class="block text-gray-700 font-semibold">Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="w-full p-2 border rounded">
            </div>

            <!-- Botón de Enviar -->
            <div class="mt-4">
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded font-semibold">Enviar</button>
            </div>
        </form>
    </div>
</main>


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
    <script>
        function agregarEspecificacion() {
            const container = document.getElementById('especificacionesContainer');

            // Crear div contenedor para la especificación
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mt-2', 'items-center');

            // Campo de Título
            const inputTitulo = document.createElement('input');
            inputTitulo.type = 'text';
            inputTitulo.name = 'especificacion_titulo[]';
            inputTitulo.placeholder = 'Título (ejem: peso)';
            inputTitulo.classList.add('p-2', 'border', 'rounded', 'flex-grow');

            // Campo de Descripción
            const inputDescripcion = document.createElement('input');
            inputDescripcion.type = 'text';
            inputDescripcion.name = 'especificacion_descripcion[]';
            inputDescripcion.placeholder = 'Descripción (ejem: 30 kg)';
            inputDescripcion.classList.add('p-2', 'border', 'rounded', 'flex-grow');

            // Botón para remover la especificación
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded');
            removeButton.textContent = 'X';
            removeButton.onclick = () => container.removeChild(div);

            // Añadir los campos al contenedor de especificaciones
            div.appendChild(inputTitulo);
            div.appendChild(inputDescripcion);
            div.appendChild(removeButton);
            container.appendChild(div);
        }
    </script>
    <script>
    function toggleDropdown(event) {
        event.preventDefault();
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("hidden");
    }
    </script>
    <script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
    </script>
</body>

</html>