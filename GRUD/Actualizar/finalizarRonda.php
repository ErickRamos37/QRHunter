<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$id_disp = $_GET["id_disp"];
$id_equipo = $_GET["id_equipo"];

try {
    $sql_estado = "UPDATE dispositivos SET idEstado = 1 WHERE id_dispositivo = ?";
    $sentencia_estado = $conn->prepare($sql_estado);
    $sentencia_estado->execute([$id_disp]);

    $sql_equipo = "UPDATE Equipos SET fin = now() WHERE id_equipo = ?";
    $sentencia_equipo = $conn->prepare($sql_equipo);
    $sentencia_equipo->execute([$id_equipo]);

    header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?success=FinalizarRonda");
    exit();
} catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    header("Location:".BASE_URL."GRUD/manejoDeErrores.php");
    echo "<h1>Error al intentar eliminar el equipo.</h1>";
    echo "<p>Causa: " . $e->getMessage() . "</p>";
}
exit();