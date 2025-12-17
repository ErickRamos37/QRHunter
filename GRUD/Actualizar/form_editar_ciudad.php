<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/views/header.php"); 

$conn = conectarBD();

if (isset($_GET['id_ciudad'])) {
    $id_ciudad = $_GET['id_ciudad'];

    $sql = "SELECT * FROM ciudades WHERE id_ciudad = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_ciudad);
    $stmt->execute();
    $ciudad = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ciudad) {
        header("Location: ../views/ciudades.php");
        exit();
    }
} else {
    header("Location: ../views/ciudades.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ciudad - QR Hunter</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin-top: 50px;">
        
        <h2 class="title-green">Editar Ciudad</h2>
        
        <form action="editar_ciudad.php" method="POST" class="form">
            
            <input type="hidden" name="id_ciudad" value="<?php echo $ciudad['id_ciudad']; ?>">

            <label for="nombre">Nombre de la Ciudad:</label>
            <input type="text" id="nombre" name="nombre" 
                   value="<?php echo htmlspecialchars($ciudad['nombre']); ?>" 
                   required class="input-box">

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                
                <button type="submit" class="buttonEditar" style="width: 100%;">Guardar Cambios</button>
                
                <a href="../../views/ciudades.php" style="width: 100%; text-decoration: none;">
                    <button type="button" class="buttonEliminar" style="width: 100%;">Cancelar</button>
                </a>
                
            </div>

        </form>
    </div>

</body>
</html>
