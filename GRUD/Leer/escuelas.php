<!DOCTYPE html>
<html lang="es">

<?php
    // Inclusión correcta (2 niveles: ../../)
    require_once("../../config/config.php"); 
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    $conn = conectarBD(); 
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Escuelas</title>
    <link rel="stylesheet" href="../../<?php echo RUTA_CSS?>styles.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>
<body>
    <div class="container">

        <h2>Lista de Escuelas Registradas</h2>
        
        <a href="<?php echo BASE_URL?>Formularios/crearEscuela.php"><button class="buttonNormal">➕ Agregar Nueva Escuela</button></a>
        

        <table id="tablaEscuelas" class="display"> 
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
                    $sql = $conn->query("SELECT id_escuela, nombre, idciudad, fecha_registro FROM escuelas ORDER BY id_escuela DESC"); 

                    while ($escuela = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($escuela["id_escuela"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["nombre"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["idciudad"]) ?></td>
                            <td><?php echo htmlspecialchars($escuela["fecha_registro"]) ?></td>
                            <td>
                                <a href="<?php echo BASE_URL?>Formularios/formularioEditarEscuela.php?id_escuela=<?php echo $escuela["id_escuela"] ?>"><button class="buttonEditar">Editar</button></a>
                                
                                <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarEscuela.php?id_escuela=<?php echo $escuela['id_escuela'] ?>" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta escuela?');"><button class="buttonEliminar">Eliminar</button></a>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaEscuelas').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "paging": true,     
                "ordering": true,   
                "info": true,       
                "searching": true   
            });
        });
    </script>
</body>
</html>