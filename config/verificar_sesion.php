<?php
// Iniciar sesión si aún no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si existe la sesión de administrador
if (empty($_SESSION['admin'])) {
    // Redirigir al login de administradores
    header('Location: /QRHunter/loginAdmin.php');
    exit();
}
?>
