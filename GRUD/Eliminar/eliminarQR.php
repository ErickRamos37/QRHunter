<?php
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

if (!isset($_GET["id_qr"])) {
    header("Location: ../../views/qr.php");
    exit();
}

$id_qr = $_GET["id_qr"];
$conn = conectarBD();

$sql = "DELETE FROM qr WHERE id_qr = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_qr]);
    
    header("Location: ../../views/qr.php");
    exit();

} catch (PDOException $e) {


    $error = urlencode($e->getMessage());
    header("Location: ../manejoDeErrores.php?mensaje=" . $error);
    exit();
}
?>