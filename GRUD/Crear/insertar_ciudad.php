<?php 
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");

$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];

    $sql = "INSERT INTO ciudades (nombre) VALUES (?)";

    try {
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$nombre]);

        header("Location: ../../views/ciudades.php");
        exit();

    } catch (PDOException $e) {
        echo "Error al insertar la ciudad: " . $e->getMessage();
    }
} else {
    header("Location: ../../views/ciudades.php");
    exit();
}
?>
