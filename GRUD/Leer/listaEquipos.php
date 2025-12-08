<!DOCTYPE html>
<html lang="es">

<?php
    require_once("../../config/config.php");
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Equipos</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>

<body>
    
    <div class="container">

        <h2>Lista de Equipos Registrados</h2>
        <a href="<?php echo BASE_URL?>GRUD/Crear/crearEquipo.php"><button class="buttonNormal">+ Agregar Nuevo Equipo</button></a>
        <table id="tablaEquipos">
            <thead>
                <tr>
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
                        dis.id_dispositivo AS Dispositivo
                        FROM Equipos eq
                        INNER JOIN escuelas es ON eq.escuela_id = es.id_escuela 
                        INNER JOIN dispositivos dis ON eq.id_disp = dis.id_dispositivo
                        ORDER BY eq.id_equipo DESC
                        LIMIT 20");

                while ($equipos = $sql->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $equipos["Nombre"] ?></td>
                        <td><?php echo $equipos["Escuela"] ?></td>
                        <td><?php echo $equipos["Dispositivo"] ?></td>
                        <td class="celdaAcciones">
                            <a href="<?php echo BASE_URL?>GRUD/Actualizar/EditarEquipo.php?id_equipo=<?php echo $equipos["id_equipo"] ?>" class="aSinMargen"><button class="buttonEditar">Editar</button></a>
                            
                            <?php
                            if(empty($equipos["fin"])) {
                                $finalizarRonda = BASE_URL . "/GRUD/Actualizar/finalizarRonda.php?id_disp=" . $equipos["id_disp"] . "&id_equipo=" . $equipos['id_equipo'];
                                echo '<a href="'.$finalizarRonda.'"><button class="buttonAdvertencia">¿Finalizar?</button></a>';
                            } else {
                                echo '<button class="buttonGris" disabled>Finalizado...</button>';
                            }
                            ?>

                            <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarEquipo.php?id_equipo=<?php echo $equipos['id_equipo'] ?>" onclick="return confirm('¿Estás seguro de eliminar este equipo?');" class="aSinMargen"><button class="buttonEliminar">Eliminar</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>

</html>