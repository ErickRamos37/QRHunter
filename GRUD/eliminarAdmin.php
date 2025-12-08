<?php
session_start();

require_once("../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
$conn = conectarBD();


// Verificar que se recibió el ID por método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_a_eliminar'])) {
    
    // Recibir el ID de la base de datos 
    $id_a_eliminar = filter_input(INPUT_POST, 'id_a_eliminar', FILTER_VALIDATE_INT);

    // Si el ID es válido, proceder con la eliminación
    if ($id_a_eliminar !== false && $id_a_eliminar !== null) {
        
        //  Consulta SQL para ELIMINAR el registro
        $sql = "DELETE FROM administradores WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        // Ejecutar la consulta con el ID recibido
        $stmt->bindParam(':id', $id_a_eliminar);
        $stmt->execute();

        // Redirigir de vuelta a la lista de administradores
        header("Location: ../views/indexAdmin.php?deleted=1");
        exit();
        
    } else {
        // Manejar caso donde el ID es inválido o no existe
        header("Location: ../views/indexAdmin.php?error=invalid_id");
        exit();
    }

} else {
    // Si no se recibe POST, redirigir a la página principal
    header("Location: ../views/indexAdmin.php");
    exit();
}
?>