<?php
// 1. Configuración
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

$conn = conectarBD();

// Verificar que lleguen datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $puntos = $_POST["puntos"];
    $ubicacion = $_POST["ubicacion"];

    $sql = "INSERT INTO qr(puntos, ubicacion) VALUES (?, ?)";

    try {
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$puntos, $ubicacion]);

        header("Location: ../../views/qr.php");
        exit();

    } 
    catch(PDOException $e) {
        echo "Error al guardar los datos: " . $e->getMessage();
    }

} else {
    header("Location: ../../views/qr.php");
    exit();
}
?>