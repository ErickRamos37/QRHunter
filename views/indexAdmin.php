<?php
session_start();

    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();

if (!isset($_SESSION['admin'])) {
    header("Location: ../loginAdmin.php");
    exit();
}

// Obtener lista de administradores
$stmt = $conn->query("SELECT * FROM administradores ORDER BY id ASC");
$lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- CSS general -->
</head>
<body>
    <div class="container">
        <h2>Lista de Administradores</h2>
        <a href="../GRUD/crearAdmin.php"><button>Crear nuevo</button></a>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['usuario'] ?></td>
                    <td>
                        <a href="../GRUD/editarAdmin.php?id=<?= $row['id'] ?>"><button>Editar</button></a>
                        <a href="../GRUD/eliminarAdmin.php?id=<?= $row['id'] ?>" onclick="return confirm('�Eliminar?');"><button>Eliminar</button></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
