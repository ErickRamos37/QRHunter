<?php
    session_start();
    require_once("../../config/config.php");
    require_once(RUTA_RAIZ."/config/verificar_sesion.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Equipos</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    
    <div class="container">

        <h2>Lista de Equipos Registrados</h2>
        <a href="<?php echo BASE_URL?>GRUD/Crear/crearEquipo.php"><button class="buttonNormal">+ Agregar Nuevo Equipo</button></a>
        <table id="tablaEquipos" class="display">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Nombre</th>
                    <th>Escuela</th>
                    <th>Dispositivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT
                        eq.id_disp, eq.id_equipo, eq.nombre AS Nombre, eq.fin,
                        es.nombre AS Escuela,
                        dis.id_dispositivo AS Dispositivo,
                        av.id_avatar, av.nombre AS Avatar
                        FROM Equipos eq
                        INNER JOIN escuelas es ON eq.escuela_id = es.id_escuela 
                        INNER JOIN dispositivos dis ON eq.id_disp = dis.id_dispositivo
                        INNER JOIN avatars av ON eq.id_avatar = av.id_avatar
                        ");

                while ($equipos = $sql->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $equipos["Avatar"] ?></td>
                        <td><?php echo $equipos["Nombre"] ?></td>
                        <td><?php echo $equipos["Escuela"] ?></td>
                        <td><?php echo $equipos["Dispositivo"] ?></td>
                        <td class="celdaAcciones">
                            <a href="<?php echo BASE_URL?>GRUD/Actualizar/EditarEquipo.php?id_equipo=<?php echo $equipos["id_equipo"] ?>"><button class="buttonEditar">Editar</button></a>
                            
                            <?php
                            if(empty($equipos["fin"])) {
                                $finalizarRonda = BASE_URL . "/GRUD/Actualizar/finalizarRonda.php?id_disp=" . $equipos["id_disp"] . "&id_equipo=" . $equipos['id_equipo'];
                                echo '<a href="'.$finalizarRonda.'"><button class="buttonAdvertencia">¿Finalizar?</button></a>';
                            } else {
                                echo '<button class="buttonGris" disabled>Finalizado...</button>';
                            }
                            ?>

                            <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarEquipo.php?id_equipo=<?php echo $equipos['id_equipo']?>&id_disp=<?php echo $equipos['id_disp']?>" onclick="return confirm('¿Estás seguro de eliminar este equipo?');"><button class="buttonEliminar">Eliminar</button></a>
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
            $('#tablaEquipos').DataTable({
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