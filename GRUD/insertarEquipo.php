<?php
include("../config/conexion.php");
$conn = conectarBD();

$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];

$sql = "Insert into usuarios(nombre, escuela_id, id_disp, esp32id) 
values (?, ?, ?, ?)";

try {
    $sentencia = $conn -> prepare($sql);
    $sentencia -> execute([$nombre, $escuela_id, $id_disp, $esp32id]);

    header("location:../views/equipos.php");
    exit();
}
catch(PDOException $e) {
    echo "Los Datos NO Se Guardaron: " . $e ->getMessage();
}