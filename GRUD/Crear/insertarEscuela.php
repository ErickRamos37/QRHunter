<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)
// y encontrar la carpeta 'config'.
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

// Recibe los datos del formulario (crearEscuela.php)
// NOTA: idciudad ahora viene del campo <select>, asegurando que sea un ID válido.
$nombre = $_POST["nombre"];
$idciudad = $_POST["idciudad"];

// Sentencia SQL para la inserción
// No se incluye id_escuela porque es AUTO_INCREMENT.
$sql = "INSERT INTO escuelas(nombre, idciudad) VALUES (?, ?)";

try {
    $sentencia = $conn->prepare($sql);
    
    // Ejecutar la sentencia con los parámetros recibidos
    $sentencia->execute([$nombre, $idciudad]);

    // Redirección exitosa: Usando BASE_URL para volver al listado de escuelas 
    // y pasar un parámetro de confirmación.
    header("location:".$BASE_URL."GRUD/Leer/escuelas.php?insertado=true");
    exit();
    
} catch (PDOException $e) {
    // Si falla la inserción (por ejemplo, si idciudad aún fuera inválido a pesar del SELECT),
    // muestra el mensaje de error.
    echo "Los Datos NO Se Guardaron: " . $e->getMessage();
    // Mensaje común: Integrity constraint violation (Clave foránea fallida)
}
?>