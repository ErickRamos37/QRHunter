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

        <h2>Registrar Nuevo Equipo</h2>
        <form id="equipoForm" method="POST" action="<?php echo BASE_URL?>GRUD/Crear/insertarEquipo.php">

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

            <label for="dispositivo">Clave Del Dispositivo:</label>
            <select id="dispositivo" name="dispositivo">
                <option disabled selected>--Elige un Dispositivo--</option>
                <?php
                $sql = $conn->query("Select disp.id_dispositivo from dispositivos disp order by id_dispositivo;");
                while ($disp = $sql->fetch()) {
                    echo "<option value='{$disp['id_dispositivo']}'>{$disp['id_dispositivo']}</option>";
                }
                ?>
            </select>
            <label for="dispositivoID">ID ESP32:</label>
            <input type="text" id="DisID" name="DisID" required>

            <button type="submit" id="buttonCentral" class="buttonNormal">Guardar Equipo</button>
        </form>
        <a href="<?php echo BASE_URL?>GRUD/Leer/listaEquipos.php"><button id="buttonCentral" class="buttonEliminar">Regresar</button></a>
    </div>
</body>
</html>