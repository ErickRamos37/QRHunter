<?php
include "../config/conexion.php";
$conn = conectarBD();

$id = $_GET['id'];

$sql = "DELETE FROM administradores WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ../views/indexAdmin.php");
exit();
?>
