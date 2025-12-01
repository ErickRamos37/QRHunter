<?php
include_once("../config/conexion.php");
$conn = conectarBD();

$id_usuario = $_GET["id_usuario"];

$sql = "delete from usuarios where id_usuario = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_usuario]);
    
    if ($sentencia->rowCount() > 0) {
        header("Location:../views/equipos.php");
    } else {
        header("Location:../views/equipos.php");
    }
    exit();
} catch (PDOException $e) {
    echo "<h1>Error al intentar eliminar el equipo.</h1>";
    echo "<p>Causa: " . $e->getMessage() . "</p>";
}
