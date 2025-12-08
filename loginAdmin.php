<?php
session_start();

include __DIR__ . "/config/conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = conectarBD();
    
    $usuario_ingresado = $_POST['usuario'];
    $password_ingresada = $_POST['password'];

    // Obtener el registro completo (incluyendo el hash de la contraseña)
    $sql = "SELECT id, usuario, password FROM administradores WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario_ingresado);
    $stmt->execute();
    
    // Obtener el registro del administrador
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($admin && password_verify($password_ingresada, $admin['password'])) {
        
        $_SESSION['admin'] = $admin['usuario']; // Usamos el usuario de la DB para más seguridad
        $_SESSION['admin_id'] = $admin['id'];
        
        // Redirigir a la página principal
        header("Location: views/principal.php");
        exit();
    } else {
    
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Admin</title>
    <link rel="stylesheet" href="views/css/styles.css">
</head>
<body>

    <div class="container login-container">
        
        <h2 class="login-title">Acceso de Administrador</h2>

        <form method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required class="input-box">

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required class="input-box">

            <?php if(!empty($error)): ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" class="buttonNormal btn-login-margin">Ingresar</button>
        </form>
        
    </div>

</body>
</html>