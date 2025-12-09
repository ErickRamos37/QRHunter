<?php
session_start();
require_once("../../config/config.php");
require_once(RUTA_RAIZ . "/config/verificar_sesion.php");
require_once(RUTA_RAIZ . "/config/conexion.php");
require_once(RUTA_RAIZ . "/views/header.php");
$conn = conectarBD();
?>
<!DOCTYPE htlm>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Avatars</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h2>Lista de Avatars</h2>
        <a href="<?php echo BASE_URL?>GRUD/Crear/crearAvatar.php"><button class="buttonNormal">+ Agregar Nuevo Avatar</button></a>
        <table id="tablaAvatars" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $sql = $conn->query("SELECT av.id_avatar AS id, av.nombre AS nombre, av.imagen AS img FROM avatars av");
                while($avatars = $sql->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $avatars["id"]?></td>
                        <td><?php echo $avatars["nombre"]?></td>
                        <td><?php echo $avatars["img"]?></td>
                        <td class="celdaAcciones">
                            <a href="<?php echo BASE_URL?>GRUD/Actualizar/editarAvatar.php?id_avatar=<?php echo $avatars['id'] ?>"><button class="buttonEditar">Editar</button></a>
                            <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarAvatar.php?idAv=<?php echo $avatars['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este avatar?');"><button class="buttonEliminar">Eliminar</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablaAvatars').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando..."
                },
                "pageLength": 10, // Mostrar 10 por defecto
                "ordering": true  // Permitir ordenar por columnas
            });
        });
    </script>
</body>

</html>