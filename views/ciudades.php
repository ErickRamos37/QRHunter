<?php
session_start(); // Iniciar sesión para comprobar si el usuario está logueado

// Incluir la conexión a la base de datos
include('../config/conexion.php');
include("header.php");

// Conectar a la base de datos
$conn = conectarBD();  // conexion con la BD.

// Si no está logueado, redirige a loginAdmin.php
if (!isset($_SESSION['admin'])) {
    header("Location: ../loginAdmin.php");
    exit;
}

// Agregar nueva ciudad si se recibe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombreCiudad'])) {
        $nombreCiudad = $_POST['nombreCiudad'];

        // Insertar la nueva ciudad en la base de datos
        $sql = "INSERT INTO ciudades (nombre) VALUES (:nombre)";
        $sentencia = $conn->prepare($sql);
        $sentencia->bindParam(':nombre', $nombreCiudad);
        $sentencia->execute();

        // Redirigir a la misma página para evitar reenvíos del formulario
        header("Location: ciudades.php");
        exit;
    }
}

// Obtener todas las ciudades de la base de datos
$sql = "SELECT * FROM ciudades"; 
$sentencia = $conn->prepare($sql);
$sentencia->execute();
$ciudades = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - CRUD de Ciudades</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <link rel="stylesheet" href="css/StylesHeader.css">
</head>
<body>

<div class="container">
    <h2>Registrar nueva Ciudad</h2>
    <form action="ciudades.php" method="POST">
        <label>Nombre de la Ciudad:</label>
        <input type="text" name="nombreCiudad" required>
        <button type="submit">Guardar Ciudad</button>
    </form>

    <h2>Lista de Ciudades</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar las ciudades desde la base de datos -->
            <?php foreach ($ciudades as $ciudad): ?>
                <tr>
                    <td><?php echo $ciudad['id_ciudad']; ?></td>
                    <td><?php echo $ciudad['nombre']; ?></td>
                    <td class="acciones">
                        <button onclick="editarCiudad(<?php echo $ciudad['id_ciudad']; ?>)">Editar</button>
                        <button onclick="eliminarCiudad(<?php echo $ciudad['id_ciudad']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function editarCiudad(id) 
    {
        // Obtener el nombre de la ciudad correspondiente
        const nombreCiudad = prompt('Editar el nombre de la ciudad:', 'Nombre de la ciudad');

        if (nombreCiudad !== null && nombreCiudad.trim() !== '') {
            // Enviar la solicitud AJAX para actualizar el nombre de la ciudad
            fetch('../GRUD/actualizar_ciudad.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'id_ciudad': id,
                    'nombreCiudad': nombreCiudad
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Ciudad actualizada con éxito.');
                    location.reload();  // Recargar la página para mostrar los cambios
                } else {
                    alert('Error al actualizar la ciudad: ' + data.error);
                }
            })
            .catch(error => {
                alert('Error al actualizar la ciudad: ' + error);
            });
        }
    }

    function eliminarCiudad(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta ciudad?')) {
        fetch('../GRUD/eliminar_ciudad.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'id_ciudad': id
            })
        })
        .then(response => response.json()) // Aquí manejamos la respuesta como JSON
        .then(data => {
            if (data.success) {
                alert('Ciudad eliminada con éxito');
                location.reload(); // Recargar la página para ver los cambios
            } else {
                alert('Error al eliminar la ciudad: ' + data.error);
            }
        })
        .catch(error => {
            alert('Error de red: ' + error);
        });
    }
}
</script>
</body>
</html>
