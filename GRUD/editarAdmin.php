<?php

include "../config/conexion.php"; 
$conn = conectarBD();

// 1. OBTENER ID y DATOS ACTUALES
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 

if ($id === false || $id === null) {
    http_response_code(400); 
    echo "<p class='error-msg'>Error: ID de administrador no válido.</p>";
    exit();
}

$stmt = $conn->prepare("SELECT id, usuario FROM administradores WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    http_response_code(404);
    echo "<p class='error-msg'>Error: Administrador no encontrado.</p>";
    exit();
}
// 2. RENDERIZAR FORMULARIO DE EDICIÓN
?>

<h3>Editar Administrador: <?= htmlspecialchars($data['usuario']) ?></h3>

<form action="indexAdmin.php" method="POST">
    <input type="hidden" name="editar_id" value="<?= $data['id'] ?>"> 

    <label>Usuario:</label>
    <input type="text" name="editar_usuario" value="<?= htmlspecialchars($data['usuario']) ?>" required>

    <label>Nueva contraseña (opcional):</label>
    <input type="password" name="editar_password" placeholder="Dejar vacío para no cambiar">

    <button type="submit" class="buttonNormal">Guardar Cambios</button>
    <button type="button" class="buttonAdvertencia" onclick="cerrarModal()">Cancelar</button>
</form>

<?php
exit();
?>