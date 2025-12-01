<?php
include('../config/conexion.php');
$conn = conectarBD();

if (isset($_POST['id_ciudad'])) {
    $id_ciudad = $_POST['id_ciudad']; 

    $sql = "DELETE FROM ciudades WHERE id_ciudad = :id_ciudad";  
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':id_ciudad', $id_ciudad);
        $stmt->execute();
        
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "No se recibió el ID"]);
}
?>
