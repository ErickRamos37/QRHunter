<?php
session_start();

// Borra todas las variables de sesion
$_SESSION = array();

// Si se usan cookies de sesion, tambien las borramos
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruye la sesion
session_destroy();

// Redirige al login
header("Location: ../loginAdmin.php");
exit();
