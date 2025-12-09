<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$nombre = $_POST["nombreAvatar"];
$imagen = $_POST["imgAvatar"];

$sql = "INSERT INTO avatars(nombre, imagen) VALUES (?, ?)";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia -> execute([$nombre, $imagen]);
    $url = BASE_URL."GRUD/Leer/listaAvatars.php";
}
catch(PDOException $e) {
    $error = urlencode($e->getMessage());
    $url = BASE_URL."GRUD/manejoDeErrores.php?mensaje=".$error;
}
header("Location:".$url);
exit();
?>