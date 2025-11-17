<?php
$servername = "mx128.hostgator.mx";
$username = "iamayaco_userexpo";
$password = "Fi@D_2025!";
$dbname = "iamayaco_juegos_expociencia";
try {
    // echo "conectando...";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establece el modo de error del PDO a excepcion 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "se establecio la conexión";
} catch (PDOException $e) {
    // Muestra un mensaje de error y termina el script
    die("Error de conexión: " . $e->getMessage());
}
