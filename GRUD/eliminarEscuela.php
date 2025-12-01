
// GRUD/eliminarEscuela.php
<?php
include_once("../config/conexion.php");
$conn = conectarBD();

// Obtener el ID de la escuela de la URL
$id_escuela = $_GET["id_escuela"];

// Sentencia DELETE
$sql = "DELETE FROM escuelas WHERE id_escuela = ?";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id_escuela]);
    
    // Redirige al listado de escuelas
    header("Location:../views/escuelas.php?eliminado=true");
    exit();
} catch (PDOException $e) {
    // Fracaso: Manejar el error (ej. si hay claves foráneas que dependen de esta escuela)
    echo "<h1>Error al intentar eliminar la escuela.</h1>";
    echo "<p>Causa: " . $e->getMessage() . "</p>";
}