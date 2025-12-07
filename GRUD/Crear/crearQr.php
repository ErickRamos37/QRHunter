<?php
// 1. Configuración y Header
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
    <title>QR Hunter - Nuevo QR</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
</head>
<body>


    <div class="container" style="max-width: 600px; margin-top: 50px;">
        
        <h2 class="title-green">Registrar nuevo QR</h2>
        
        <form action="insertarQR.php" method="POST" class="form-qr">
            
            <label for="puntos">Valor (Puntos):</label>
            <input type="number" id="puntos" name="puntos" required placeholder="Ej: 50" class="input-box">

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required placeholder="Ej: Cafetería" class="input-box">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                
                <button type="submit" class="buttonNormal" style="width: 100%;">Guardar QR</button>
                
                <a href="../../views/qr.php" style="width: 100%; text-decoration: none;">
                    <button type="button" class="buttonEliminar" style="width: 100%;">Cancelar</button>
                </a>
                
            </div>

        </form>
    </div>

</body>
</html>