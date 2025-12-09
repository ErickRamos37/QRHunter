<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$id_avatar = $_POST["idAv"];
$nombre = $_POST["nombreAvatar"];
$imagen = $_POST["imgAvatar"];

try {
    $sql = "UPDATE avatars SET nombre = ?, imagen = ? WHERE id_avatar = ?";
    $sentencia = $conn->prepare($sql);
    $sentencia -> execute([$nombre, $imagen, $id_avatar]);
    $url = BASE_URL."GRUD/Leer/listaAvatars.php";
}
catch(PDOException $e) {
    $error = urlencode($e->getMessage());
    $url = BASE_URL."GRUD/manejoDeErrores.php?mensaje=".$error;
}
header("Location:".$url);
exit();
?>