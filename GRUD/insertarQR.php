<?php
include("../config/conexion.php");
$conn = conectarBD();

$puntos = $_POST["puntos"];
$ubicacion = $_POST["ubicacion"];


$sql = "INSERT INTO qr(puntos, ubicacion) VALUES (?, ?)";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$puntos, $ubicacion]);

    header("location:../views/qr.php");
    exit();

} catch(PDOException $e) {
    echo "Error al guardar los datos: " . $e->getMessage();
}
?>