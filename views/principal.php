<?php
session_start();

// Verificar que el admin haya iniciado sesion
if (!isset($_SESSION['admin'])) {
    header("Location: ../loginAdmin.php");
    exit();
}

    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    require_once(RUTA_RAIZ."/config/verificar_sesion.php");
    $conn = conectarBD();

// Incluir header con navbar
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Area de Administrador - QR Hunter</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h2>Bienvenido al Panel de Administracion</h2>
        <p>Hola, <span id="welcomeUser"><?php echo $_SESSION['admin']; ?></span>!</p>
        <p>Utiliza el menu superior para navegar a las herramientas de gestion.</p>
    </div>

    <script>
        // Logica para el Cierre de Sesion usando PHP
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
