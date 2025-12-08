<!DOCTYPE html>
<html lang="es">

<?php
    require_once(RUTA_RAIZ."/config/conexion.php"); 
    $conn = conectarBD();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Hunter - Navegación</title>
    <link rel="stylesheet" href="<?php echo RUTA_CSS?>StylesHeader.css">
</head>

<body>
    <header>
        <h1 class="titleheader">QR Hunter</h1>
        <nav>
            <ul class="nav-links">
                <li><a href="<?php echo BASE_URL?>views/dashboard.php">Ranking</a></li>
                <li><a href="<?php echo BASE_URL?>GRUD/Leer/listaEquipos.php">Equipos</a></li>
                <li><a href="<?php echo BASE_URL?>GRUD/Leer/escuelas.php">Escuelas</a></li>
                <li><a href="<?php echo BASE_URL?>views/ciudades.php">Ciudades</a></li>
                <li><a href="<?php echo BASE_URL?>views/dispositivos.php">Dispositivos</a></li>
                <li><a href="<?php echo BASE_URL?>views/qr.php">QR</a></li>

                <div class="dropdown">
                    <button class="dropbtn"><?php echo $_SESSION['admin']?></button>
                    
                    <div class="dropdown-content">
                        <a href="<?php echo BASE_URL?>views/indexAdmin.php">Administadores</a>
                        <a href="<?php echo BASE_URL?>logout.php">Cerrar Sesión</a>
                </div>
            </ul>
        </nav>
    </header>
    </body>
</html>