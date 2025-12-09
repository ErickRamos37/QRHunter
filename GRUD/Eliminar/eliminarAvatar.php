<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$AVATAR_POR_DEFECTO = 1;
$id_avatar = $_GET["idAv"];

if ($id_avatar == $AVATAR_POR_DEFECTO) {
    ob_end_clean();
    $error = urlencode("No se puede eliminar el avatar por defecto (ID: 1).");
    header("Location:".BASE_URL."GRUD/manejoDeErrores.php?mensaje=".$error);
    exit();
}

try {
    $sql_reasignar = "UPDATE Equipos SET id_avatar = ? WHERE id_avatar = ?";
    $sentencia_reasignar = $conn->prepare($sql_reasignar);
    $sentencia_reasignar->execute([$AVATAR_POR_DEFECTO, $id_avatar]);

    $sql = "DELETE FROM avatars WHERE id_avatar = ?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_avatar]);

    header("Location:".BASE_URL."GRUD/Leer/listaAvatars.php?success=deleted");
}
catch(PDOException $e) {
    $error = urlencode($e->getMessage());
    header("Location:".BASE_URL."GRUD/manejoDeErrores.php?mensaje=".$error);
}
exit();
?>