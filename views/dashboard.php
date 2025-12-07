<!DOCTYPE html>
<?php
    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php");
    require_once("../config/conexion.php");
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
?>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>QR Hunter - Dashboard</title>
        <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
    </head>
    <body>
        <div>
            <h2>Ranking De Los Mejores Equipos - QRHunters</h2>
        </div>
    </body>
</html>