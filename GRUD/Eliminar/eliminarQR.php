<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

$conn = conectarBD();
?>

<?php

$id_qr = $_GET["id_qr"];

$sql = "DELETE FROM qr WHERE id_qr = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_qr]);
    
    header("Location: ../../views/qr.php");
    exit();

} catch (PDOException $e) {
    echo "<h1>No se pudo eliminar</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<a href='../views/qr.php'>Volver</a>";
}
?>