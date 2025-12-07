
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
    <title>QR Hunter - Escuelas</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css">
</head>
<body>
    <div class="container">

        <h2>Lista de Escuelas Registradas</h2>
        <table id="tablaEscuelas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>ID Ciudad</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Sentencia SELECT para la tabla escuelas
                    $sql = $conn->query("SELECT id_escuela, nombre, idciudad, fecha_registro FROM escuelas ORDER BY id_escuela DESC LIMIT 20");

                    while ($escuela = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($escuela["id_escuela"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["nombre"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["idciudad"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["fecha_registro"]) ?></td>
                            <td>
                                <a href="../Formularios/formularioEditarEscuela.php?id_escuela=<?php echo $escuela["id_escuela"] ?>"><button>Editar</button></a>
                                <a href="../GRUD/eliminarEscuela.php?id_escuela=<?php echo $escuela['id_escuela'] ?>" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta escuela?');"><button>Eliminar</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                } catch (Exception $e) {
                    echo "<tr><td colspan='5'>Error al cargar datos: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>