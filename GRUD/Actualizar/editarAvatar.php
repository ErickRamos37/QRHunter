<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ . "/config/verificar_sesion.php");
require_once(RUTA_RAIZ . "/config/conexion.php");
require_once(RUTA_RAIZ . "/views/header.php");
$conn = conectarBD();
?>
<!DOCTYPE htlm>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Avatars</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Avatar</h2>
        <form id="avatarForm" method="POST" action="<?php echo BASE_URL?>GRUD/Actualizar/actualizarAvatar.php">
            <?php
            $sql = "SELECT av.id_avatar, av.imagen, av.nombre FROM avatars av WHERE av.id_avatar = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_REQUEST["id_avatar"]]);
            $row = $stmt->fetch();
            ?>

            <input type="Hidden" name="idAv" value="<?php echo htmlspecialchars($row['id_avatar']); ?>" required>

            <label for="nombreAvatar">Nombre del Avatar</label>
            <input type="text" id="nombreAvatar" name="nombreAvatar" value="<?php echo htmlspecialchars($row['nombre']);?>" required>

            <label for="ImgAvatar">Avatar (Imagen)</label>
            <input type="text" id="imgAvatar" name="imgAvatar" value="<?php echo htmlspecialchars($row['imagen']);?>"  required>

            <button type="submit" id="buttonCentral" class="buttonNormal">Guardar Avatar</button>
        </form>
        <a href="<?php echo BASE_URL?>GRUD/Leer/listaAvatars.php"><button id="buttonCentral" class="buttonEliminar">Regresar</button></a>
    </div>
</body>
</html>