<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Hunter - Gestión de QRs</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    require("../config/conexion.php");
    require("header.php"); 
    $conn = conectarBD();
    ?>
    
    <div class="container">
        
        <h2 class="title-green">Registrar nuevo QR</h2>
        
        <form action="../GRUD/insertarQR.php" method="POST" class="form-qr">
            
            <label for="puntos">Valor (Puntos):</label>
            <input type="number" id="puntos" name="puntos" required placeholder="" class="input-box">

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required placeholder="" class="input-box">

            <button type="submit" class="btn-guardar">Guardar QR</button>
        </form>

        <h2 class="title-green">Lista de QRs</h2>

        <table class="table-qr">
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Valor</th>
                    <th style="width: 40%;">Ubicación</th>
                    <th style="width: 30%;">Acciones</th>
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
                            <a href="../Formularios/formularioEditarQR.php?id_qr=<?php echo $row['id_qr']; ?>">
                                <button type="button">Editar</button>
                            </a>
                            
                            <a href="../GRUD/eliminarQR.php?id_qr=<?php echo $row['id_qr']; ?>" 
                            onclick="return confirm('¿Seguro que quieres borrar este QR?');">
                                <button type="button">Eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>