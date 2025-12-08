<?php
    session_start();
    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/verificar_sesion.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Equipos Error</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>
<body>
    <div class="container">
        <h2>Hubo un Error</h2>
        <p>Hubo un error. Intenta de nuevo con otro nombre o espera un momento y vuelve a intentarlo.</p>
        <a href="<?php echo BASE_URL?>GRUD/Leer/listaEquipos.php"><button class="buttonAdvertencia">Regresar</button></a>
    </div>
</body>
