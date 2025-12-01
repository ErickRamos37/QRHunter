<?php
include "../Config/conexion.php";
$conn = conectarBD();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM administradores WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pass    = $_POST['password'];

    $sql = "UPDATE administradores SET usuario=:usuario, password=:password WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $pass);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: indexAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Admin</title>
</head>
<body>

<h2>Editar Administrador</h2>

<form method="POST">
    Usuario: <input type="text" name="usuario" value="<?= $data['usuario'] ?>"><br><br>
    Password: <input type="text" name="password" value="<?= $data['password'] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

</body>
</html>
