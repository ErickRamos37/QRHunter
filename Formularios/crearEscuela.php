<!DOCTYPE html>
<html lang="es">

<?php
    // --- INCLUSIONES ---
    // La ruta aquí se asume la correcta: '../config/config.php'
    require_once("../config/config.php"); 
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();

    // 1. OBTENER LA LISTA DE CIUDADES VÁLIDAS
    try {
        $sql_ciudades = $conn->query("SELECT id_ciudad, nombre FROM ciudades ORDER BY nombre");
        $ciudades = $sql_ciudades->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Manejo de error si no se pueden cargar las ciudades
        echo "<p style='color:red; text-align:center;'>Error al cargar ciudades: " . $e->getMessage() . "</p>";
        $ciudades = []; // Asegura que la variable esté definida
    }
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Crear Escuela</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>
<body>
    <div class="container">

        <h2>Registrar Nueva Escuela</h2>
        
        <form id="escuelaForm" method="POST" action="<?php echo BASE_URL?>GRUD/Crear/insertarEscuela.php">

            <label for="nombre">Nombre de la Escuela:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="idciudad">Ciudad:</label>
            <select id="idciudad" name="idciudad" required>
                <?php if (empty($ciudades)): ?>
                    <option value="" disabled selected>— No hay ciudades registradas para seleccionar —</option>
                <?php else: ?>
                    <option value="" disabled selected>Selecciona una ciudad</option>
                    <?php 
                    // 2. Llenar el SELECT con ID y Nombre de la tabla ciudades
                    foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo htmlspecialchars($ciudad['id_ciudad']); ?>">
                            <?php echo htmlspecialchars($ciudad['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <button class="buttonNormal" type="submit">Guardar Escuela</button>
        </form>
        
        <a href="<?php echo BASE_URL?>views/escuelas.php"><button id="buttonCentral" class="buttonEliminar" type="button">Cancelar</button></a>
    </div>
</body>
</html>