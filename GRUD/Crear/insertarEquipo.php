<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];

$sql = "Insert into Equipos(nombre, escuela_id, id_disp, esp32id) 
values (?, ?, ?, ?)";

try {
    $sentencia = $conn -> prepare($sql);
    $sentencia -> execute([$nombre, $escuela_id, $id_disp, $esp32id]);

    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php");
    exit();
}
catch(PDOException $e) {
    echo "Los Datos NO Se Guardaron: " . $e ->getMessage();
}