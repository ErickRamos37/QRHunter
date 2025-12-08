// GRUD/editarEscuela.php
<?php
include_once("../config/conexion.php");
$conn = conectarBD();

$id_escuela = $_POST["id_escuela"];
$nombre = $_POST["nombre"];
$idciudad = $_POST["idciudad"];

// Sentencia UPDATE: Solo actualizamos nombre e idciudad
$sql = "UPDATE escuelas SET
    nombre = ?,
    idciudad = ?
WHERE 
    id_escuela = ?";

try {
    $sentencia = $conn->prepare($sql);

    $sentencia->execute([
        $nombre,
        $idciudad,
        $id_escuela  
    ]);

    // Redirecciona al listado con un mensaje de éxito/no cambios
    if ($sentencia->rowCount() > 0) {
        header("Location:../views/escuelas.php?actualizado=true");
        exit();
    } else {
        header("Location:../views/escuelas.php?aviso=no_cambios");
        exit();
    }
} catch (PDOException $e) {
    // Fracaso: Manejar el error
    echo "<h1>Error al actualizar los datos</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}