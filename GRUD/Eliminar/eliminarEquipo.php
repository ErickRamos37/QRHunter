<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

if (!isset($_GET["id_equipo"]) || !is_numeric($_GET["id_equipo"])) {
    header("Location:".BASE_URL."views/equipos.php?error=no_id");
    exit();
}

$id_disp = $_GET["id_disp"];
$id_equipo = $_GET["id_equipo"];

try {
    $sql_estado = "UPDATE dispositivos SET idEstado = 1 WHERE id_dispositivo = ?";
    $sentencia_estado = $conn->prepare($sql_estado);
    $sentencia_estado->execute([$id_disp]);

    $sql_puntos = "delete from puntos where equipo_id = ?";
    $sentencia_puntos = $conn->prepare($sql_puntos);
    $sentencia_puntos->execute([$id_equipo]);

    $sql_equipo = "delete from Equipos where id_equipo = ?";
    $sentencia_equipo = $conn->prepare($sql_equipo);
    $sentencia_equipo->execute([$id_equipo]);

    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?success=deleted");

} catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    $error = urlencode($e->getMessage());
    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?mensaje=".$error);
}
exit();
?>