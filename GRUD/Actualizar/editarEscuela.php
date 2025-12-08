<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)

require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

// OBTENER DATOS DE POST
$id_escuela = $_POST["id_escuela"];
$nombre = $_POST["nombre"];
$idciudad = $_POST["idciudad"];

// Sentencia UPDATE
$sql = "UPDATE escuelas SET
    nombre = ?,
    idciudad = ?
WHERE 
    id_escuela = ?";

try {
    $sentencia = $conn->prepare($sql);

    $sentencia->execute([
        $nombre,
        $idciudad,
        $id_escuela  
    ]);

    // Redirección CORREGIDA: Usando BASE_URL para volver al listado
 if ($sentencia->rowCount() > 0) {
        // Redirige al listado con un mensaje de éxito
        header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?actualizado=true");
        exit();
    } else {
        // Redirige al listado si no hubo cambios
       header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?aviso=no_cambios");
        exit();
    }
// ...
} catch (PDOException $e) {
    // Fracaso: Manejar el error
    echo "<h1>Error al actualizar los datos</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>