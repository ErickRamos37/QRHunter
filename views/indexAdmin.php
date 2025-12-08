<?php
session_start();

// 1. INCLUSIONES Y CONEXIÓN
require_once("../config/config.php"); 
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
require_once(RUTA_RAIZ."/config/verificar_sesion.php");
$conn = conectarBD();

$error_creacion = '';

// PROCESAR CREACIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_usuario'])) {
    
    $password_original = $_POST['crear_password'];
    $password_confirm = $_POST['crear_password_confirm'];
    
    // Verificar que las contraseñas coincidan 
    if ($password_original !== $password_confirm) {
        $error_creacion = "Error: Las contraseñas no coinciden. Por favor, revísalas.";
    } else {
        // La validación fue exitosa, proceder a insertar:
        $usuario = trim($_POST['crear_usuario']);
        $nombre = trim($_POST['crear_nombre']);

        $ap_Paterno = empty($_POST['crear_apellido_paterno']) ? NULL : trim($_POST['crear_apellido_paterno']);
        $ap_Materno = empty($_POST['crear_apellido_materno']) ? NULL : trim($_POST['crear_apellido_materno']);
        
        $password_hash = password_hash($password_original, PASSWORD_BCRYPT);
        
        // Ejecutar inserción
        $stmt = $conn->prepare("INSERT INTO administradores (usuario, nombre, ap_Paterno, ap_Materno, password) 
                                 VALUES (?, ?, ?, ?, ?)");
        
        $stmt->execute([$usuario, $nombre, $ap_Paterno, $ap_Materno, $password_hash]);
        
        header("Location: indexAdmin.php?created=1");
        exit;
    }
}

// PROCESAR EDICIÓN 
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

// OBTENER LISTA DE ADMINS
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
    <h3>Crear Nuevo Administrador</h3>
    
    <form method="POST" class="form-box" onsubmit="return validarCreacion();">
        
        <?php if (!empty($error_creacion)): ?>
            <p style="color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffeaea; border-radius: 4px;"><?= $error_creacion ?></p>
        <?php endif; ?>
        
        <label>Usuario:</label>
        <input type="text" name="crear_usuario" required>
        
        <label>Nombre:</label>
        <input type="text" name="crear_nombre" required>
        
        <label>Apellido Paterno: (opcional)</label>
        <input type="text" name="crear_apellido_paterno">
        
        <label>Apellido Materno: (opcional)</label>
        <input type="text" name="crear_apellido_materno">
        
        <label>Contraseña:</label>
        <input type="password" name="crear_password" id="crear_password" required>
        
        <label>Confirmar Contraseña:</label>
        <input type="password" name="crear_password_confirm" id="crear_password_confirm" required>
        
        <button type="submit" class="buttonNormal btn-login-margin" >Crear</button>
    </form>
    
    <hr>
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
                    <button class="buttonEditar" onclick="cargarFormularioEdicion(<?= $row['id'] ?>)">
                        Editar
                    </button>
                    <button class="buttonEliminar" onclick="abrirModalEliminar(<?= $row['id'] ?>, '<?= htmlspecialchars($row['usuario'], ENT_QUOTES) ?>')">
                        Eliminar
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php 
include 'modals/modal_editar.php'; 
include 'modals/modal_eliminar.php'; 
?>

<script src="js/admin_interfaz.js?v=2"></script>

</body>
</html>