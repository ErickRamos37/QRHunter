<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)
// y encontrar la carpeta 'config'.
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

// Obtener el ID de la escuela de la URL (Método GET)
if (isset($_GET["id_escuela"])) {
    $id_escuela = $_GET["id_escuela"];
} else {
    // Si no hay ID, redirige al listado
    header("Location:".$BASE_URL."GRUD/Leer/escuelas.php?error=no_id");
    exit();
}

// Sentencia DELETE: Elimina la fila basada en el id_escuela
$sql = "DELETE FROM escuelas WHERE id_escuela = ?";

try {
    $sentencia = $conn->prepare($sql);
    
    // Ejecutar la sentencia con el ID de la escuela
    $sentencia->execute([$id_escuela]);
    
    // Redirige al listado: Usando BASE_URL para volver al listado de escuelas 
    // y pasar un parámetro de confirmación.
    header("Location:".$BASE_URL."GRUD/Leer/escuelas.php?eliminado=true");
    exit();
    
} catch (PDOException $e) {
    // Manejo del error: Si hay una restricción de clave foránea (FK)
    // (ejemplo: si hay alumnos registrados en esta escuela)
    if ($e->getCode() == '23000') {
        echo "<h1>Error al intentar eliminar la escuela.</h1>";
        echo "<p>No puedes eliminar esta escuela porque tiene registros asociados (alumnos, etc.).</p>";
        echo "<p>Causa Técnica: " . $e->getMessage() . "</p>";
    } else {
        echo "<h1>Error desconocido al intentar eliminar la escuela.</h1>";
        echo "<p>Causa Técnica: " . $e->getMessage() . "</p>";
    }
}
?>