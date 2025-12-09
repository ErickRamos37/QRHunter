<!DOCTYPE html>
<html lang="es">

<?php
    // Rutas originales antes de la corrección a ../../
    session_start();
    require_once("../../config/config.php"); 
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    require_once(RUTA_RAIZ."/views/header.php");
    require_once(RUTA_RAIZ."/config/verificar_sesion.php");


    $conn = conectarBD(); 
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Escuelas</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>styles.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">

        <h2>Lista de Escuelas Registradas</h2>
        
        <div class="header-acciones" style="justify-content: flex-start; margin-bottom: 20px;">
            <a href="<?php echo BASE_URL?>Formularios/crearEscuela.php"><button class="buttonNormal">+ Agregar Nueva Escuela</button></a>
        </div>
        
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
                            
                            <td style="display: flex; justify-content: center; gap: 10px;">
                                <a href="<?php echo BASE_URL?>GRUD/Actualizar/formularioEditarEscuela.php?id_escuela=<?php echo $escuela["id_escuela"] ?>">
                                    <button class="buttonEditar">Editar</button>
                                </a>
                                
                                <a href="<?php echo BASE_URL?>GRUD/Eliminar/eliminarEscuela.php?id_escuela=<?php echo $escuela['id_escuela'] ?>"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar esta escuela?');">
                                    <button class="buttonEliminar">Eliminar</button>
                                </a>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablaEscuelas').DataTable({
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