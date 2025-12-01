<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Hunter - Navegación</title>
    <link rel="stylesheet" href="css/StylesHeader.css">
</head>

<body>
    <header>
        <h1 class="titleheader">QR Hunter</h1>
        <nav>
            <ul class="nav-links">
                <li><a href="../views/ranking.php">Ranking</a></li>
                <li><a href="../views/equipos.php">Equipos</a></li>
                <li><a href="../views/escuelas.php">Escuelas</a></li>
                <li><a href="../views/ciudades.php">Ciudades</a></li>
                <li><a href="../views/dispositivos.php">Dispositivos</a></li>
                <li><a href="../views/qr.php">QR</a></li>

                <li class="dropdown">
                    <button class="dropbtn"><?php echo isset($_SESSION['admin']) ? $_SESSION['admin'] : 'Usuario'; ?> &#x25BC;</button>
                    <div class="dropdown-content">
                        <a href="indexAdmin.php">Administradores</a>
                        <a href="logout.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    </body>

</html>