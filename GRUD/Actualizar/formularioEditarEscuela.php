<!DOCTYPE html>
<html lang="es">

<?php
    // --- INCLUSIÓN CORREGIDA (SOLO SUBE UN NIVEL ../) ---
    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();

    // 1. Obtener la lista de ciudades válidas
    try {
        $sql_ciudades = $conn->query("SELECT id_ciudad, nombre FROM ciudades ORDER BY nombre");
        $ciudades = $sql_ciudades->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p style='color:red; text-align:center;'>Error al cargar ciudades: " . $e->getMessage() . "</p>";
        $ciudades = [];
    }

    // 2. Obtener los datos de la escuela a editar
    if (!isset($_REQUEST["id_escuela"])) {
        header("Location:".$BASE_URL."GRUD/Leer/escuelas.php?error=no_id");
        exit;
    }

    $sql = "SELECT id_escuela, nombre, idciudad FROM escuelas WHERE id_escuela = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_REQUEST["id_escuela"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("Location:".$BASE_URL."GRUD/Leer/escuelas.php?error=escuela_no_encontrada");
        exit;
    }
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
        
        <form action="<?php echo BASE_URL?>GRUD/Actualizar/editarEscuela.php" method="POST">
            

            <input type="Hidden" name="id_escuela" required value="<?php echo htmlspecialchars($row['id_escuela']); ?>">

            <label for="nombre">Nombre de la Escuela:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($row['nombre']); ?>">

            <label for="idciudad">Ciudad:</label>
            <select id="idciudad" name="idciudad" required>
                <?php if (empty($ciudades)): ?>
                    <option value="" disabled>— No hay ciudades disponibles —</option>
                <?php else: 
                    foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo htmlspecialchars($ciudad['id_ciudad']); ?>"
                            <?php echo ($ciudad['id_ciudad'] == $row['idciudad']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($ciudad['nombre']); ?>
                        </option>
                    <?php endforeach;
                endif; ?>
            </select>
            
            <button type="submit" class="buttonNormal">Guardar Cambios</button>
            
            <a href="<?php echo BASE_URL?>GRUD/Leer/escuelas.php">
                <button type="button" class="buttonEliminar">Cancelar</button>
            </a>
        </form>
    </div>
</body>
</html>