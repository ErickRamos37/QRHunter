<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/config/verificar_sesion.php");

$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_qr = $_POST["id_qr"];
    $puntos = $_POST["puntos"];
    $ubicacion = $_POST["ubicacion"];

    $sql = "UPDATE qr SET puntos = ?, ubicacion = ? WHERE id_qr = ?";

    try {
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$puntos, $ubicacion, $id_qr]);

        header("Location: ../../views/qr.php");
        exit();

    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
} else {
    header("Location: ../../views/qr.php");
    exit();
}
?>