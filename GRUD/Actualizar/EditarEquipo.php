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
    <title>QR Hunter - Editar Equipo</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>

<body>
    <div class="container">
        <h2>Editar Equipo</h2>
        <form action="<?php echo BASE_URL?>GRUD/Actualizar/actualizarEquipo.php" method="POST">
            <?php
            $sql = "SELECT eq.id_equipo, eq.nombre AS Nombre, eq.esp32id AS ClaveDisp,
            es.id_escuela, es.nombre AS Escuela, 
            dis.id_dispositivo AS Dispositivo, 
            av.id_avatar, av.nombre
        FROM Equipos eq
        INNER JOIN escuelas es ON eq.escuela_id = es.id_escuela 
        INNER JOIN dispositivos dis ON eq.id_disp = dis.id_dispositivo
        INNER JOIN avatars av ON eq.id_avatar = av.id_avatar
        WHERE eq.id_equipo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_REQUEST["id_equipo"]]);
            $row = $stmt->fetch();
            ?>

            <input type="Hidden" name="idUser" required value="<?php echo htmlspecialchars($row['id_equipo']); ?>">

            <label for="nombreEquipo">Nombre del Equipo:</label>
            <input type="text" id="nombreEquipo" name="nombreEquipo" required value="<?php echo htmlspecialchars($row['Nombre']); ?>">



            <label for="avatar">Seleccionar Avatar:</label>
            <select id="avatar" name="avatar" required>
                <option disabled selected>--Elige un Avatar--</option>
                <?php
                $avatar_actual_id = isset($row['id_avatar']) ? $row['id_avatar'] : null;
                $sql_avatar = $conn->query("SELECT av.id_avatar, av.nombre FROM avatars av ORDER BY av.nombre");
                while ($av = $sql_avatar->fetch(PDO::FETCH_ASSOC)) {

                    // Determina si esta es la opción actualmente seleccionada
                    $selected = ($av['id_avatar'] == $avatar_actual_id) ? 'selected' : '';  

                    // Imprime la opción
                    echo "<option value='{$av['id_avatar']}' {$selected}>{$av['nombre']}</option>";
                }
                ?>
            </select>

            <label for="escuela">Seleccionar Escuela:</label>
            <select id="escuela" name="escuela" required>
                <option disabled selected>--Elige un Escuela--</option>
                <?php
                $escuela_actual_id = isset($row['id_escuela']) ? $row['id_escuela'] : null;
                $sql_escuelas = $conn->query("SELECT es.id_escuela, nombre FROM escuelas es ORDER BY nombre");

                while ($escuela = $sql_escuelas->fetch(PDO::FETCH_ASSOC)) {

                    // Determina si esta es la opción actualmente seleccionada
                    $selected = ($escuela['id_escuela'] == $escuela_actual_id) ? 'selected' : '';

                    // Imprime la opción
                    echo "<option value='{$escuela['id_escuela']}' {$selected}>{$escuela['nombre']}</option>";
                }
                ?>
            </select>

            <label for="dispositivo">Dispositivo:</label>
            <select id="dispositivo" name="dispositivo" required>
                <option disabled selected>--Elige un Dispositivo--</option>
                <?php
                $dispositivo_actual_id = isset($row['Dispositivo']) ? $row['Dispositivo'] : null;
                $sql_dispositivos = $conn->query("SELECT id_dispositivo, descripcion FROM dispositivos WHERE idEstado = 1 OR id_dispositivo = '{$dispositivo_actual_id}' ORDER BY descripcion ASC");

                while ($disp = $sql_dispositivos->fetch(PDO::FETCH_ASSOC)) {

                    // Determina si esta opción dexbe estar seleccionada
                    $seleccionado = ($disp['id_dispositivo'] == $dispositivo_actual_id) ? 'selected' : '';

                    // El valor (value) y el texto visible son el mismo ID (id_dispositivo)
                    echo "<option value='{$disp['id_dispositivo']}' {$seleccionado}>";
                    echo htmlspecialchars($disp['id_dispositivo']); // Usamos la descripción del dispositivo
                    echo "</option>";
                }
                ?>
            </select>
            <label for="dispositivoID">ID Del ESP32:</label>
            <input type="text" id="DisID" name="DisID" required value="<?php echo $row['ClaveDisp']; ?>">

            <button type="submit" id="buttonCentral" class="buttonNormal">Guardar Equipo</button> 
        </form>
        <a href="<?php echo BASE_URL?>GRUD/Leer/listaEquipos.php"><button id="buttonCentral" class="buttonEliminar">Cancelar</button></a>
    </div>
</body>