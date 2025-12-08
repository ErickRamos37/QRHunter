<!DOCTYPE html>
<html lang="es">

<?php
    // Bloque de inclusión solicitado (2 niveles arriba)
    require_once("../../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
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
        <form id="escuelaForm" method="POST" action="../GRUD/Crear/insertarEscuela.php">

            <label for="nombre">Nombre de la Escuela:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="idciudad">ID de la Ciudad:</label>
            <input type="number" id="idciudad" name="idciudad" required min="1">

            <button class="buttonNormal" type="submit">Guardar Escuela</button>
        </form>
        <a href="../GRUD/Leer/escuelas.php"><button id="buttonCentral" class="buttonEliminar" type="button">Cancelar</button></a>
    </div>
</body>
</html>