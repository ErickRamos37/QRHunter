<?php
session_start();
include __DIR__ . "/config/conexion.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = conectarBD();
    
    $usuario = $_POST['usuario'];
    $pass    = $_POST['password'];

    $sql = "SELECT * FROM administradores WHERE usuario = :usuario AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['admin'] = $usuario;
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