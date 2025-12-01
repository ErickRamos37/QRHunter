<?php
include "../Config/conexion.php";
$conn = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pass    = $_POST['password'];

    $sql = "INSERT INTO administradores (usuario, password) VALUES (:usuario, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();

    header("Location: ../views/indexAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Admin</title>
</head>
<body>

<h2>Crear Nuevo Administrador</h2>

<form method="POST">
    Usuario: <input type="text" name="usuario" required><br><br>
    Password: <input type="text" name="password" required><br><br>
    <button type="submit">Guardar</button>
</form>

</body>
</html>
