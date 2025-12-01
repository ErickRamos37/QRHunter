// GRUD/insertarEscuela.php
<?php
include("../config/conexion.php");
$conn = conectarBD();

$nombre = $_POST["nombre"];
$idciudad = $_POST["idciudad"];

// Sentencia INSERT: fecha_registro se llena automáticamente con NOW() en la BD si el campo lo permite, 
// o se podría incluir en el INSERT como NOW() o CURRENT_TIMESTAMP(). 
// Asumo que la columna tiene un valor por defecto o se gestiona sola.
// Si no se gestiona sola, se debe incluir: fecha_registro = NOW() en el SQL y el '?' en VALUES
$sql = "INSERT INTO escuelas(nombre, idciudad) VALUES (?, ?)";

try {
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$nombre, $idciudad]);

    // Redirige al listado de escuelas después de la inserción
    header("location:../views/escuelas.php?insertado=true");
    exit();
} catch (PDOException $e) {
    // Muestra un error si la inserción falla
    echo "Los Datos NO Se Guardaron: " . $e->getMessage();
}