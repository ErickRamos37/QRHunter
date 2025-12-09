<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)
// y encontrar la carpeta 'config'.
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php"); // Puedes considerar eliminar esta línea si no se usa HTML.
$conn = conectarBD();

// Obtener el ID de la escuela de la URL (Método GET)
if (isset($_GET["id_escuela"])) {
    $id_escuela = $_GET["id_escuela"];
} else {
    // Si no hay ID, redirige al listado con un error
    header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=no_id");
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
   header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?eliminado=true");

    exit();
    
} catch (PDOException $e) {
    // Manejo del error: Si hay una restricción de clave foránea (FK)
    // (ejemplo: si hay alumnos registrados en esta escuela)
    if ($e->getCode() == '23000') {
        // Error de integridad referencial (Foreign Key Constraint)
       header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=fk_alumnos");
        exit();
    } else {
        // Otros errores de base de datos.
        // Se recomienda redirigir a una página de error o mostrar un mensaje.
        echo "<h1>Error al eliminar los datos</h1>";
        echo "<h2>Detalles Técnicos:</h2>";
        echo "<p>" . $e->getMessage() . "</p>";
    }
}
?>