<?php
// Configuración
session_start();
require_once("../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/views/header.php");
require_once(RUTA_RAIZ."/config/verificar_sesion.php");
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking en Vivo - QR Hunter</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
    </head>
<body>

<div class="ranking-container">
    <h1 class="title-green">Tabla de Posiciones </h1>
    <p>Clasificación por Puntos y Tiempo</p>

    <table class="table-ranking">
        <thead>
            <tr>
                <th style="width: 15%;">Posición</th>
                <th style="width: 35%;">Equipo</th>
                <th style="width: 25%;">Puntos</th>
                <th style="width: 25%;">Tiempo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $sql = "
                    SELECT 
                        e.nombre AS nombre_equipo,
                        SUM(q.puntos) AS total_puntos,
                        TIMEDIFF(MAX(p.fecha_registro), e.inicio) AS tiempo_tomado,
                        e.inicio
                    FROM puntos p
                    JOIN Equipos e ON p.equipo_id = e.id_equipo
                    JOIN qr q ON p.qr_id = q.id_qr
                    GROUP BY e.id_equipo, e.nombre, e.inicio
                    ORDER BY 
                        total_puntos DESC,     
                        tiempo_tomado ASC    
                ";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                $posicion = 1;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    
                    $clase_fila = "";
                    $icono = "#" . $posicion;
                    if ($posicion == 1) { $clase_fila = "rank-1"; $icono = "🥇 1°"; }
                    elseif ($posicion == 2) { $clase_fila = "rank-2"; $icono = "🥈 2°"; }
                    elseif ($posicion == 3) { $clase_fila = "rank-3"; $icono = "🥉 3°"; }

                    $tiempo = $row['tiempo_tomado'];
                    if ($tiempo == null) {
                        $tiempo_mostrado = "--:--:--";
                    } else {
                        $tiempo_mostrado = $tiempo . " hrs";
                    }
            ?>
                <tr class="<?php echo $clase_fila; ?>">
                    <td style="font-weight: bold;"><?php echo $icono; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_equipo']); ?></td>
                    <td class="puntos-destacados"><?php echo $row['total_puntos']; ?> pts</td>
                    
                    <td class="fecha-escaneo" style="font-size: 1.1rem; font-weight: bold; color: #555;">
                        ⏱ <?php echo $tiempo_mostrado; ?>
                    </td>
                </tr>
            <?php 
                    $posicion++;
                }

                if ($posicion == 1) {
                    echo "<tr><td colspan='4'>Esperando datos...</td></tr>";
                }

            } catch (PDOException $e) {
                echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    setInterval(function(){
        location.reload();
    }, 5000);
</script>

</body>
</html>