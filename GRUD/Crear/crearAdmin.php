<?php
session_start();

require_once("../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/config/verificar_sesion.php");
$conn = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_usuario'])) {
    
    $password_original = $_POST['crear_password'];
    $password_confirm = $_POST['crear_password_confirm'];
    
    // Validación de Contraseñas
    if ($password_original !== $password_confirm) {
        // Redirigir de vuelta al indexAdmin.php con un parámetro de error
        header("Location: ../views/indexAdmin.php?error=pass_mismatch");
        exit;
    } 
    
    $usuario = trim($_POST['crear_usuario']);
    $nombre = trim($_POST['crear_nombre']);

    // Limpieza y manejo de opcionales (NULL)
    $ap_Paterno = empty($_POST['crear_apellido_paterno']) ? NULL : trim($_POST['crear_apellido_paterno']);
    $ap_Materno = empty($_POST['crear_apellido_materno']) ? NULL : trim($_POST['crear_apellido_materno']);
    
    $password_hash = password_hash($password_original, PASSWORD_BCRYPT);
    
    $stmt = $conn->prepare("INSERT INTO administradores (usuario, nombre, ap_Paterno, ap_Materno, password) 
                             VALUES (?, ?, ?, ?, ?)");
    
    $stmt->execute([$usuario, $nombre, $ap_Paterno, $ap_Materno, $password_hash]);
    
    // Redirección de éxito
    header("Location: ../views/indexAdmin.php?created=1");
    exit;
} else {
    // Si alguien intenta acceder directamente al archivo sin POST, redirigir
    header("Location: ../views/indexAdmin.php");
    exit;
}
?>