<!DOCTYPE html>
<html lang="es">

<?php
    require_once("../../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Editar Escuela</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>

<body>
    <div class="container">
        <h2>Editar Escuela</h2>
        <form action="../GRUD/editarEscuela.php" method="POST">
            <?php
            // Sentencia SELECT para obtener la escuela a editar
            $sql = "SELECT id_escuela, nombre, idciudad FROM escuelas WHERE id_escuela = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_REQUEST["id_escuela"]]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                echo "<p>Escuela no encontrada.</p>";
                exit;
            }
            ?>

            <input type="Hidden" name="id_escuela" required value="<?php echo htmlspecialchars($row['id_escuela']); ?>">

            <label for="nombre">Nombre de la Escuela:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($row['nombre']); ?>">

            <label for="idciudad">ID de la Ciudad:</label>
            <input type="number" id="idciudad" name="idciudad" required min="1" value="<?php echo htmlspecialchars($row['idciudad']); ?>">

            <button type="submit">Guardar Cambios</button>
            <a href="../views/escuelas.php">
                <button type="button">Cancelar</button>
            </a>
        </form>
    </div>
</body>

</html>