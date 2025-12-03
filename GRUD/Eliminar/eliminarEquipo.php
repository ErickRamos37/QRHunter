<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

if (!isset($_GET["id_equipo"]) || !is_numeric($_GET["id_equipo"])) {
    // Manejar error si no hay ID válido
    header("Location:".BASE_URL."views/equipos.php?error=no_id");
    exit();
}

$id_equipo = $_GET["id_equipo"];

try {
    $sql_puntos = "delete from puntos where equipo_id = ?";
    $sentencia_puntos = $conn->prepare($sql_puntos);
    $sentencia_puntos->execute([$id_equipo]);

    $sql_equipo = "delete from Equipos where id_equipo = ?";
    $sentencia_equipo = $conn->prepare($sql_equipo);
    $sentencia_equipo->execute([$id_equipo]);

    $conn->commit();
    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?success=deleted");

} catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?error=delete_fail");
    echo "<h1>Error al intentar eliminar el equipo.</h1>";
    echo "<p>Causa: " . $e->getMessage() . "</p>";
}
exit();
?>