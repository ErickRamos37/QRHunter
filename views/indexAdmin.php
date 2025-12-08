<?php
session_start();
    require_once("../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    require_once(RUTA_RAIZ."/config/verificar_sesion.php");
    $conn = conectarBD();

//  PROCESAR CREACIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_usuario'])) {

    $usuario = trim($_POST['crear_usuario']);
    $password = password_hash($_POST['crear_password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO administradores (usuario, password) VALUES (?, ?)");
    $stmt->execute([$usuario, $password]);

    header("Location: indexAdmin.php?created=1");
    exit;
}

//  PROCESAR EDICIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_id'])) {

    $id = $_POST['editar_id'];
    $usuario = trim($_POST['editar_usuario']);
    $password = $_POST['editar_password'];

    if (!empty($password)) {
        $passHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE administradores SET usuario=?, password=? WHERE id=?");
        $stmt->execute([$usuario, $passHash, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE administradores SET usuario=? WHERE id=?");
        $stmt->execute([$usuario, $id]);
    }

    header("Location: indexAdmin.php?edited=1");
    exit;
}

//  OBTENER LISTA DE ADMINS
$stmt = $conn->query("SELECT * FROM administradores ORDER BY id ASC");
$lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">

    <h2>Administradores</h2>

    <!-- FORM CREAR -->
    <h3>Crear Nuevo Administrador</h3>
    <form method="POST" class="form-box">
        <label>Usuario:</label>
        <input type="text" name="crear_usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="crear_password" required>

        <button type="submit" class="buttonNormal btn-login-margin" >Crear</button>
    </form>

    <hr>

    <!-- LISTA -->
    <h3>Lista de Administradores</h3>

    <table class="table-admin">
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
                    <button class="buttonEditar" onclick="abrirModal('<?= $row['id'] ?>', '<?= $row['usuario'] ?>')">
                        Editar
                    </button>

                    <a href="../GRUD/eliminarAdmin.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('¿Eliminar administrador <?= $row['usuario']?>?');">
                        <button class="buttonEliminar">Eliminar</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<!-- MODAL EDITAR -->
<div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3>Editar Administrador</h3>

        <form method="POST">
            <input type="hidden" name="editar_id" id="editar_id">

            <label>Usuario:</label>
            <input type="text" name="editar_usuario" id="editar_usuario" required>

            <label>Nueva contraseña (opcional):</label>
            <input type="password" name="editar_password">

            <button type="submit" class="buttonNormal">Guardar Cambios</button>
        </form>
    </div>
</div>


<script>
function abrirModal(id, usuario) {
    document.getElementById("editar_id").value = id;
    document.getElementById("editar_usuario").value = usuario;
    document.getElementById("modalEditar").style.display = "block";
}

function cerrarModal() {
    document.getElementById("modalEditar").style.display = "none";
}
</script>

</body>
</html>
