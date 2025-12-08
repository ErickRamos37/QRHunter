<?php
// Incluir la configuración y constantes del proyecto (config.php)
// Se retrocede dos niveles (../../) para llegar a la raíz/config
require_once("../../config/config.php"); 
// Incluir la conexión a la base de datos usando RUTA_RAIZ
require_once(RUTA_RAIZ."/config/conexion.php");
// Incluir el header usando RUTA_RAIZ
require_once(RUTA_RAIZ."/views/header.php");

// Conectar a la base de datos
$conn = conectarBD();

// No es necesario el código HTML/CSS/JS de la cabecera en un script de procesamiento, 
// pero si fuera necesario para una respuesta de error con estilo, se vería así:
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Actualización</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css"> 
</head>
<body>
    <?php
    // Recibir datos del formulario (POST)
    $id_escuela = $_POST["id_escuela"];
    $nombre = $_POST["nombre"];
    $idciudad = $_POST["idciudad"];

    // Sentencia UPDATE: Solo actualizamos nombre e idciudad
    $sql = "UPDATE escuelas SET
        nombre = ?,
        idciudad = ?
    WHERE 
        id_escuela = ?";

    try {
        $sentencia = $conn->prepare($sql);

        $sentencia->execute([
            $nombre,
            $idciudad,
            $id_escuela  
        ]);

        // Redireccionamiento al listado (../../views/escuelas.php)
        if ($sentencia->rowCount() > 0) {
            header("Location:../../views/escuelas.php?actualizado=true");
            exit();
        } else {
            // Si rowCount es 0, significa que no hubo cambios en los datos.
            header("Location:../../views/escuelas.php?aviso=no_cambios");
            exit();
        }
    } catch (PDOException $e) {
        // Fracaso: Manejar el error mostrando una página con estilo
        ?>
        <div class="container">
            <h2 class="login-title">Error al actualizar la Escuela</h2>
            <div class="error-msg">
                <p>Ocurrió un problema durante la actualización de los datos.</p>
                <p>Detalles Técnicos: <?php echo htmlspecialchars($e->getMessage()); ?></p>
            </div>
            <a href="../../views/escuelas.php">
                <button class="buttonNormal" id="buttonCentral" style="max-width: 300px; margin-top: 20px;">Volver al Listado</button>
            </a>
        </div>
        <?php
    }
    ?>
</body>
</html>