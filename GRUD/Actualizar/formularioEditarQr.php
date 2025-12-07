<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/views/header.php"); 

$conn = conectarBD();

if (isset($_GET['id_qr'])) {
    $id_qr = $_GET['id_qr'];

    $sql = "SELECT * FROM qr WHERE id_qr = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_qr);
    $stmt->execute();
    $qr = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$qr) {
        header("Location: ../views/qr.php");
        exit();
    }
} else {
    header("Location: ../views/qr.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar QR - QR Hunter</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin-top: 50px;">
        
        <h2 class="title-green">Editar QR Existente</h2>
        
        <form action="editarQR.php" method="POST" class="form-qr">
            
            <input type="hidden" name="id_qr" value="<?php echo $qr['id_qr']; ?>">

            <label for="puntos">Valor (Puntos):</label>
            <input type="number" id="puntos" name="puntos" 
                   value="<?php echo $qr['puntos']; ?>" 
                   required class="input-box">

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" 
                   value="<?php echo $qr['ubicacion']; ?>" 
                   required class="input-box">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                
                <button type="submit" class="buttonEditar" style="width: 100%;">Actualizar QR</button>
                
                <a href="../../views/qr.php" style="width: 100%; text-decoration: none;">
                    <button type="button" class="buttonEliminar" style="width: 100%;">Cancelar</button>
                </a>
                
            </div>

        </form>
    </div>

</body>
</html>