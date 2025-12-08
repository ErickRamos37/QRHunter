<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_ciudad = $_POST["id_ciudad"];
    $nombre = $_POST["nombre"];

    $sql = "UPDATE ciudades SET nombre = ? WHERE id_ciudad = ?";

    try {
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$nombre, $id_ciudad]);

        header("Location: ../../views/ciudades.php");
        exit();

    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
} else {
    header("Location: ../../views/ciudades.php");
    exit();
}
?>
