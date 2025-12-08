<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

$conn = conectarBD();

$id_ciudad = $_GET["id_ciudad"];

$sql = "DELETE FROM ciudades WHERE id_ciudad = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_ciudad]);
    
    header("Location: ../../views/ciudades.php");
    exit();

} catch (PDOException $e) {
    echo "<h1>No se pudo eliminar la ciudad</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<a href='../views/ciudades.php'>Volver</a>";
}
?>