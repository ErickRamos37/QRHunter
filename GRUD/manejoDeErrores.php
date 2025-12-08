<!DOCTYPE html>
<html lang="es">

<?php
    require_once("../config/config.php"); 
    require_once(RUTA_RAIZ."/config/conexion.php"); 
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Error</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>
<body>

<?php 
    // Capturamos el mensaje de error de la URL
    $mensaje_error = isset($_GET['mensaje']) ? $_GET['mensaje'] : "Ocurrió un error inesperado. Por favor intenta de nuevo.";
?>

    <div class="container container-error">
        
        <span class="icon-warning">⚠️</span>

        <h2 class="title-green title-error">¡Ups! Hubo un problema</h2>
        
        <p class="text-error">
            <?php echo htmlspecialchars($mensaje_error); ?>
        </p>

        <button class="buttonAdvertencia" onclick="window.history.back()">
            Regresar
        </button>

        <br>
        
        <a href="<?php echo BASE_URL ?>views/dashboard.php" class="link-home">
            Ir al Inicio
        </a>

    </div>
</body>
</html>