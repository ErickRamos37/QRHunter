<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ . "/config/verificar_sesion.php");
require_once(RUTA_RAIZ . "/config/conexion.php");
require_once(RUTA_RAIZ . "/views/header.php");
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Avatars</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>

<body>
    <div class="container">
        <h2>Registrar Nuevo Avatar</h2>
        <form id="avatarForm" method="POST" action="<?php echo BASE_URL?>GRUD/Crear/insertarAvatar.php">
            
            <label for="nombreAvatar">Nombre del Avatar</label>
            <input type="text" id="nombreAvatar" name="nombreAvatar" required>
            
            <label for="ImgAvatar">Avatar (Imagen)</label>
            <input type="text" id="imgAvatar" name="imgAvatar" required>

            <button type="submit" id="buttonCentral" class="buttonNormal">Guardar Avatar</button>
        </form>
        <a href="<?php echo BASE_URL?>GRUD/Leer/listaAvatars.php"><button id="buttonCentral" class="buttonEliminar">Regresar</button></a>
    </div>
</body>
</html>