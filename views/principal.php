<?php
session_start();

    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();

// Verificar que el admin haya iniciado sesi�n
if (!isset($_SESSION['admin'])) {
    header("Location: ../loginAdmin.php");
    exit();
}


// Incluir header con navbar
// require("header.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>�rea de Administrador - QR Hunter</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h2>Bienvenido al Panel de Administracion</h2>
        <p>Hola, <span id="welcomeUser"><?php echo $_SESSION['admin']; ?></span>!</p>
        <p>Utiliza el menu superior para navegar a las herramientas de gestion.</p>
    </div>

    <script>
        // L�gica para el Cierre de Sesi�n usando PHP
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
