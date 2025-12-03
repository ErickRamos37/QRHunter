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
    <title>QR Hunter - Editar Equipo</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>

<body>
    <div class="container">
        <h2>Editar Producto</h2>
        <form action="<?php echo BASE_URL?>GRUD/Actualizar/actualizarEquipo.php" method="POST">
            <?php
            $sql =
                "Select eq.id_equipo, eq.nombre as Nombre, es.id_escuela, es.nombre as Escuela, dis.id_dispositivo as Dispositivo, eq.esp32id as ClaveDisp 
                from Equipos eq, escuelas es, dispositivos dis 
                where eq.id_equipo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_REQUEST["id_equipo"]]);
            $row = $stmt->fetch()
            ?>

            <input type="Hidden" name="idUser" required value="<?php echo htmlspecialchars($row['id_equipo']); ?>">

            <label for="nombreEquipo">Nombre del Equipo:</label>
            <input type="text" id="nombreEquipo" name="nombreEquipo" required value="<?php echo htmlspecialchars($row['Nombre']); ?>">

            <label for="avatar">Seleccionar Avatar:</label>
            <select id="avatar" name="avatar">
                <option disabled selected>--Elige un avatar--</option>
            </select>

            <label for="escuela">Seleccionar Escuela:</label>
            <select id="escuela" name="escuela">
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
            <select id="dispositivo" name="dispositivo">
                <option disabled selected>--Elige un Dispositivo--</option>
                <?php
                $dispositivo_actual_id = isset($row['Dispositivo']) ? $row['Dispositivo'] : null;

                // Consulta para obtener TODOS los dispositivos (ID y nombre, si lo hay)
                $sql_dispositivos = $conn->query("SELECT dis.id_dispositivo as Dispositivo FROM dispositivos dis ORDER BY id_dispositivo");

                while ($disp = $sql_dispositivos->fetch(PDO::FETCH_ASSOC)) {

                    // Determina si esta opción debe estar seleccionada
                    $selected = ($disp['Dispositivo'] == $dispositivo_actual_id) ? 'selected' : '';

                    // El valor (value) y el texto visible son el mismo ID (id_dispositivo)
                    echo "<option value='{$disp['Dispositivo']}' {$selected}>{$disp['Dispositivo']}</option>";
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