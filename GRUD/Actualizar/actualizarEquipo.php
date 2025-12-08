<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

$id_equipo = $_POST["idUser"];
$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];

$sql = "update Equipos set
    nombre = ?,
    escuela_id = ?,
    id_disp = ?,
    esp32id = ?
WHERE 
    id_equipo = ?";
try {
    $sentencia = $conn->prepare($sql);

    $sentencia->execute([
        $nombre,
        $escuela_id,
        $id_disp,
        $esp32id,
        $id_equipo  
    ]);

    if ($sentencia->rowCount() > 0) {
        header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?actualizado=true");
        exit();
    } else {
        header("Location:".BASE_URL."GRUD/Leer/listaEquipos.php?aviso=no_cambios");
        exit();
    }
} catch (PDOException $e) {
    // Fracaso: Manejar el error
    echo "<h1>Error al actualizar los datos</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    header("Location:".BASE_URL."GRUD/manejoDeErrores.php");
    exit();
}
