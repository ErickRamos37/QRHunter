<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar QR</title>
    <link rel="stylesheet" href="../views/css/styles.css">
</head>
<body>
    <?php
    require("../config/conexion.php");
    require("../views/header.php");
    $conn = conectarBD();
    ?>

    <div class="container">
        <h2 style="color: #1b5e20; text-align: center;">Editar QR</h2>

        <?php
        // 1. Obtener los datos del QR que seleccionaste
        $id_qr = $_GET['id_qr'];
        
        $sql = "SELECT * FROM qr WHERE id_qr = ?";
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$id_qr]);
        $qr = $sentencia->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="../GRUD/editarQR.php" method="POST">
            
            <input type="hidden" name="id_qr" value="<?php echo $qr['id_qr']; ?>">

            <label for="puntos">Puntos:</label>
            <input type="number" id="puntos" name="puntos" 
                   value="<?php echo $qr['puntos']; ?>" class="input-box" required>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" 
                   value="<?php echo $qr['ubicacion']; ?>" class="input-box" required>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-guardar" style="flex: 1;">Guardar Cambios</button>
                
                <a href="../views/qr.php" style="flex: 1;">
                    <button type="button" style="width: 100%; background-color: #666; color: white; padding: 12px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                        Cancelar
                    </button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>