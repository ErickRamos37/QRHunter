<?php
$servername = "mx128.hostgator.mx";
$username   = "iamayaco_userexpo";
$password   = "Fi@D_2025!";
$dbname     = "iamayaco_juegos_expociencia";

function conectarBD() {
    global $servername, $username, $password, $dbname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>