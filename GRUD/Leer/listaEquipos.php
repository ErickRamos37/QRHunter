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
        <a href="<?php echo BASE_URL?>GRUD/Crear/crearEquipo.php"><button class="buttonNormal">Agregar Nuevo Equipo</button></a>
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
                $sql = $conn->query("Select eq.id_equipo, eq.nombre as Nombre, es.id_escuela, es.nombre as Escuela, dis.id_dispositivo as Dispositivo 
                        from Equipos eq, escuelas es, dispositivos dis
                        group by id_equipo order by id_equipo desc
                        limit 20");

                while ($equipos = $sql->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $equipos["Nombre"] ?></td>
                        <td><?php echo $equipos["Escuela"] ?></td>
                        <td><?php echo $equipos["Dispositivo"] ?></td>
                        <td>
                            <a href="<?php echo BASE_URL?>GRUD/Actualizar/EditarEquipo.php?id_equipo=<?php echo $equipos["id_equipo"] ?>"><button class="buttonEditar">Editar</button></a>
                            <a href=""><button class="buttonAdvertencia">Finalizar Ronda</button></a>
                            <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarEquipo.php?id_equipo=<?php echo $equipos['id_equipo'] ?>" onclick="return confirm('¿Estás seguro de eliminar este equipo?');"><button class="buttonEliminar">Eliminar</button></a>
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