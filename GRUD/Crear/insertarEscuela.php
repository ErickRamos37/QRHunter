<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)
// y encontrar la carpeta 'config'.
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
// Nota: header.php no es estrictamente necesario en este script de procesamiento, pero lo incluimos por consistencia.
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

// Recibe los datos del formulario (crearEscuela.php)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Si no es POST, redirige con error (o simplemente al listado)
    header("location:".$BASE_URL."GRUD/Leer/escuelas.php?error=metodo_no_valido");
    exit();
}

// Validación básica de datos
$nombre = $_POST["nombre"] ?? null;
$idciudad = $_POST["idciudad"] ?? null;

if (empty($nombre) || empty($idciudad)) {
    header("location:".$BASE_URL."GRUD/Leer/escuelas.php?error=datos_faltantes");
    exit();
}

// Sentencia SQL para la inserción
// Se incluye NOW() para la columna fecha_registro
$sql = "INSERT INTO escuelas(nombre, idciudad, fecha_registro) VALUES (?, ?, NOW())";

try {
    $sentencia = $conn->prepare($sql);
    
    // Ejecutar la sentencia con los parámetros recibidos
    $sentencia->execute([$nombre, $idciudad]);

    // Redirección exitosa: Usando BASE_URL para volver al listado de escuelas
    header("location:".$BASE_URL."GRUD/Leer/escuelas.php?insertado=true");
    exit();
    
} catch (PDOException $e) {
    // Si falla la inserción (ej: clave foránea idciudad no existe)
    // Se puede mostrar el error o redirigir con un mensaje de fallo.
    echo "<h1>Error al insertar la escuela</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    // O podrías redirigir: header("location:".$BASE_URL."GRUD/Leer/escuelas.php?error=fallo_db"); exit();
}

?>