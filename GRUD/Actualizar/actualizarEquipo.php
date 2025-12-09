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
$fin = $_POST["fin"];
$id_avatar = $_POST["avatar"];

try {
$sql_previo = "SELECT id_disp FROM Equipos WHERE id_equipo = ?";
$sentencia_previo = $conn->prepare($sql_previo);
$sentencia_previo->execute([$id_equipo]);

$equipo_previo = $sentencia_previo->fetch(PDO::FETCH_ASSOC);

$id_disp_anterior = $equipo_previo['id_disp'];
$ronda_finalizada = !empty($equipo_previo['fin']);

if (!$ronda_finalizada && ($id_disp_anterior != $id_disp)) {
    $sql_liberar = "UPDATE dispositivos SET idEstado = 1 WHERE id_dispositivo = ?";
    $sentencia_liberar = $conn->prepare($sql_liberar);
    $sentencia_liberar->execute([$id_disp_anterior]);

    $sql_ocupar = "UPDATE dispositivos SET idEstado = 2 WHERE id_dispositivo = ?";
    $sentencia_ocupar = $conn->prepare($sql_ocupar);
    $sentencia_ocupar->execute([$id_disp]);
} elseif (!$ronda_finalizada && ($id_disp_anterior == $id_disp) && !empty($id_disp)) {
        $sql_ocupar_mismo = "UPDATE dispositivos SET idEstado = 2 WHERE id_dispositivo = ?";
        $sentencia_ocupar_mismo = $conn->prepare($sql_ocupar_mismo);
        $sentencia_ocupar_mismo->execute([$id_disp]);
    }


$sql = "UPDATE Equipos SET
    nombre = ?,
    escuela_id = ?,
    id_disp = ?,
    esp32id = ?,
    id_avatar = ?
WHERE 
    id_equipo = ?";

    $sentencia = $conn->prepare($sql);

    $sentencia->execute([
        $nombre,
        $escuela_id,
        $id_disp,
        $esp32id,
        $id_avatar,
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
    $error = urlencode($e->getMessage());
    header("Location:".BASE_URL."GRUD/manejoDeErrores.php");
    exit();
}
