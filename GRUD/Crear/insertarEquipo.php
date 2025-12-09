<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];
$id_avatar = $_POST["avatar"];

$sql_estado = "UPDATE dispositivos SET idEstado = 2 WHERE id_dispositivo = ?";
$sentencia_estado = $conn->prepare($sql_estado);
$sentencia_estado->execute([$id_disp]);

$sql = "INSERT INTO Equipos(nombre, escuela_id, id_disp, esp32id, id_avatar)
VALUES (?, ?, ?, ?, ?)";

try {
    $sentencia = $conn -> prepare($sql);
    $sentencia -> execute([$nombre, $escuela_id, $id_disp, $esp32id, $id_avatar]);
    $url = BASE_URL."GRUD/Leer/listaEquipos.php";
}
catch(PDOException $e) {
    $error = urlencode($e->getMessage());
    $url = BASE_URL."GRUD/manejoDeErrores.php?mensaje=".$error;
}
header("Location:".$url);
exit();