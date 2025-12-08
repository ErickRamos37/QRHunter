<?php
session_start();

// Destruye la sesion
session_destroy();

// Redirige al login
header("Location: /QRHunter/loginAdmin.php");
exit();
?>