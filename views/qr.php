<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Lista de QRs</title>
    
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>styles.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>
<body>

    <div class="container">
        
        <h2 class="title-green" style="text-align: center; margin-bottom: 30px;">Lista de QRs Registrados</h2>

        <div class="header-acciones">
            <a href="../GRUD/Crear/crearQr.php" class="buttonNormal" style="text-decoration: none;">
                + Agregar Nuevo QR
            </a>
        </div>

        <table id="tablaQRs" class="table-qr display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM qr ORDER BY id_qr ASC");
                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $row['id_qr']; ?></td>
                        <td><?php echo $row['puntos']; ?></td>
                        <td><?php echo $row['ubicacion']; ?></td>
                        
                        <td style="display: flex; justify-content: center; gap: 10px;">
                            <a href="../GRUD/Actualizar/formularioEditarQr.php?id_qr=<?php echo $row['id_qr']; ?>">
                                <button type="button" class="buttonEditar">Editar</button>
                            </a>
                            
                            <a href="../GRUD/eliminar/eliminarQR.php?id_qr=<?php echo $row['id_qr']; ?>" 
                               onclick="return confirm('¿Seguro que quieres borrar este QR?');">
                                <button type="button" class="buttonEliminar">Eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaQRs').DataTable({
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