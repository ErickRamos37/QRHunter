<?php
include_once("../config/conexion.php");
$id_usuario = $_POST["idUser"];
$nombre = $_POST["nombreEquipo"];
$escuela_id = $_POST["escuela"];
$id_disp = $_POST["dispositivo"];
$esp32id = $_POST["DisID"];

$sql = "update usuarios set
    nombre = ?,
    escuela_id = ?,
    id_disp = ?,
    esp32id = ?
WHERE 
    id_usuario = ?";
try {
    $sentencia = $conn->prepare($sql);

    $sentencia->execute([
        $nombre,
        $escuela_id,
        $id_disp,
        $esp32id,
        $id_usuario  
    ]);

    if ($sentencia->rowCount() > 0) {
        header("Location:../views/equipos.php?actualizado=true");
        exit();
    } else {
        header("Location:../views/equipos.php?aviso=no_cambios");
        exit();
    }
} catch (PDOException $e) {
    // Fracaso: Manejar el error
    echo "<h1>Error al actualizar los datos</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
