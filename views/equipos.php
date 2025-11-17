<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Equipos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    require("../Config/conexion.php");
    require("header.php");
    ?>
    <div class="container">

        <h2>Registrar Nuevo Equipo</h2>
        <form id="equipoForm" method="POST" action="../GRUD/insertarEquipo.php">

            <label for="nombreEquipo">Nombre del Equipo:</label>
            <input type="text" id="nombreEquipo" name="nombreEquipo" required>

            <label for="avatar">Seleccionar Avatar:</label>
            <select id="avatar" name="avatar">
                <option disabled selected>--Elige un avatar--</option>
            </select>

            <label for="escuela">Seleccionar Escuela:</label>
            <select id="escuela" name="escuela">
                <option disabled selected>--Elige un Escuela--</option>
                <?php
                $sql = $conn->query("Select es.nombre, es.id_escuela from escuelas es order by nombre;");
                while ($escuela = $sql->fetch()) {
                    echo "<option value='{$escuela['id_escuela']}'>{$escuela['nombre']}</option>";
                }
                ?>
            </select>

            <label for="dispositivo">Dispositivo (ID ESP32):</label>
            <select id="dispositivo" name="dispositivo">
                <option disabled selected>--Elige un Dispositivo--</option>
                <?php
                $sql = $conn->query("Select disp.id_dispositivo from dispositivos disp order by id_dispositivo;");
                while ($disp = $sql->fetch()) {
                    echo "<option value='{$disp['id_dispositivo']}'>{$disp['id_dispositivo']}</option>";
                }
                ?>
            </select>
            <label for="dispositivoID">Clave Del Dispositivo:</label>
            <input type="text" id="DisID" name="DisID" required>

            <button type="submit">Guardar Equipo</button>
        </form>

        <h2>Lista de Equipos Registrados</h2>
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
                $sql = $conn->query("Select u.id_usuario, u.nombre as Nombre, es.id_escuela, es.nombre as Escuela, dis.id_dispositivo as Dispositivo 
                        from usuarios u, escuelas es, dispositivos dis
                        group by id_usuario order by id_usuario desc
                        limit 10");

                while ($equipos = $sql->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $equipos["Nombre"] ?></td>
                        <td><?php echo $equipos["Escuela"] ?></td>
                        <td><?php echo $equipos["Dispositivo"] ?></td>
                        <td>
                            <a href=""><button>Finalizar Ronda</button></a>
                            <a href="../Formularios/formularioEditarEquipo.php?id_usuario=<?php echo $equipos["id_usuario"] ?>"><button>Editar</button></a>
                            <a href="../GRUD/eliminarEquipo.php?id_usuario=<?php echo $equipos['id_usuario'] ?>"><button>Eliminar</button></a>
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