<?php
session_start();
require_once("../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php");
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - CRUD de Ciudades</title>
    
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
    
    <!-- dataTable del poderosisimo CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container">

    <h2 class="title-green" style="text-align: center; margin-bottom: 30px;">Lista de Ciudades Registradas</h2>

    <div class="header-acciones" style="text-align: center; margin-bottom: 20px;">
        <a href="../GRUD/Crear/form_insertar_ciudad.php" class="buttonNormal" style="text-decoration: none;">
            + Agregar Nueva Ciudad
        </a>
    </div>

    <!-- tabla de las ciudades -->
    <table id="tablaCiudades" class="table-ciudades display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Obtener todas las ciudades en orden ascendente //
            $sql = "SELECT * FROM ciudades ORDER BY id_ciudad ASC"; 
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $ciudades = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($ciudades as $ciudad): ?>
                <tr>
                    <td><?php echo $ciudad['id_ciudad']; ?></td>
                    <td><?php echo $ciudad['nombre']; ?></td>
                    <td style="display: flex; justify-content: center; gap: 10px;">

                        <!-- boton de editar de color azul -->
                        <a href="../GRUD/Actualizar/form_editar_ciudad.php?id_ciudad=<?php echo $ciudad['id_ciudad']; ?>">
                            <button type="button" class="buttonEditar">Editar</button>
                        </a>
                        
                        <!-- boton para eliminar ciudades (color rojo) -->
                        <a href="../GRUD/Eliminar/eliminar_ciudad.php?id_ciudad=<?php echo $ciudad['id_ciudad']; ?>" 
                           onclick="return confirm('¿Estás seguro de que deseas eliminar esta ciudad?');">
                            <button type="button" class="buttonEliminar">Eliminar</button>
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tablaCiudades').DataTable({
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
            "pageLength": 10, 
            "ordering": true,  
        });
    });
</script>

</body>
</html>