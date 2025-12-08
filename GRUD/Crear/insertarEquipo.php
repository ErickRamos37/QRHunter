<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];

$sql = "INSERT INTO Equipos(nombre, escuela_id, id_disp, esp32id) 
VALUES (?, ?, ?, ?)";

try {
    $sentencia = $conn -> prepare($sql);
    $sentencia -> execute([$nombre, $escuela_id, $id_disp, $esp32id]);
    $url = BASE_URL."GRUD/Leer/listaEquipos.php";
}
catch(PDOException $e) {
    echo "Los Datos NO Se Guardaron: " . $e ->getMessage();
    $url = BASE_URL."GRUD/manejoDeErrores.php";
}
header("Location:".$url);
exit();