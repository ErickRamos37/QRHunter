<?php
include("../config/conexion.php");
$conn = conectarBD();

$id_qr = $_POST["id_qr"];
$puntos = $_POST["puntos"];
$ubicacion = $_POST["ubicacion"];

$sql = "UPDATE qr SET puntos = ?, ubicacion = ? WHERE id_qr = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$puntos, $ubicacion, $id_qr]);

    header("Location:../views/qr.php");
    exit();

} catch (PDOException $e) {
    echo "Error al actualizar: " . $e->getMessage();
}
?>