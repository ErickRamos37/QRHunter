<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Nueva Ciudad</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
</head>
<body>

    <div class="container" style="max-width: 600px; margin-top: 50px;">
        
        <h2 class="title-green">Registrar Nueva Ciudad</h2>
        
        <form action="insertar_ciudad.php" method="POST" class="form">
            
            <label for="nombre">Nombre de la Ciudad:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Ensenada" class="input-box">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                
                <button type="submit" class="buttonNormal" style="width: 100%;">Guardar Ciudad</button>
                
                <a href="../../views/ciudades.php" style="width: 100%; text-decoration: none;">
                    <button type="button" class="buttonEliminar" style="width: 100%;">Cancelar</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
