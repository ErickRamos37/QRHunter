<?php
    include('../config/conexion.php');
    $conn = conectarBD();

    if (isset($_POST['nombreCiudad'])) {
        $nombreCiudad = $_POST['nombreCiudad'];

        $sql = "INSERT INTO ciudades (nombre) VALUES (:nombre)";
        $stmt = $conn->prepare($sql);
    
        try {
            $stmt->bindParam(':nombre', $nombreCiudad);
            $stmt->execute();
        
            echo json_encode(["success" => true]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
    }
?>
