<?php
include('../config/conexion.php');
$conn = conectarBD();

if (isset($_POST['id_ciudad']) && isset($_POST['nombreCiudad'])) {
    $id_ciudad = $_POST['id_ciudad'];  
    $nombreCiudad = $_POST['nombreCiudad'];  

    $sql = "UPDATE ciudades SET nombre = :nombre WHERE id_ciudad = :id_ciudad"; 
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':nombre', $nombreCiudad);
        $stmt->bindParam(':id_ciudad', $id_ciudad);
        $stmt->execute();
        
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>
