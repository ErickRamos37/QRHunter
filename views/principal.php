<?php
session_start();

// Verificar que el admin haya iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: ../loginAdmin.php");
    exit();
}

// Incluir header con navbar
require("header.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Área de Administrador - QR Hunter</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h2>Bienvenido al Panel de Administracion</h2>
        <p>Hola, <span id="welcomeUser"><?php echo $_SESSION['admin']; ?></span>!</p>
        <p>Utiliza el menu superior para navegar a las herramientas de gestion.</p>
    </div>

    <script>
        // Lógica para el Cierre de Sesión usando PHP
        const logoutBtn = document.querySelector('nav a[href="../logout.php"], nav a[href="#"]');

        if(logoutBtn){
            logoutBtn.addEventListener('click', function(event) {
                event.preventDefault();
                // Redirige al script PHP de logout
                window.location.href = 'logout.php';
            });
        }
    </script>

</body>
</html>
