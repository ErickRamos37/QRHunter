<?php
// --- INCLUSIONES Y CONFIGURACIÓN ---
// Asegúrate de que la ruta de inclusión sea correcta (dos niveles arriba si el script está en GRUD/Crear/)
require_once("../../config/config.php"); 
require_once(RUTA_RAIZ."/config/conexion.php");
// No es necesario iniciar sesión si solo se está insertando, 
// pero puede que lo necesites para la verificación de permisos.

$conn = conectarBD();

// 1. Verificar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Recibir y sanitizar los datos
    // Usamos filter_input para mayor seguridad y claridad
    $nombre_escuela = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_ciudad = filter_input(INPUT_POST, 'idciudad', FILTER_VALIDATE_INT);

    // 3. Validar datos (básico)
    if (empty($nombre_escuela) || $id_ciudad === false || $id_ciudad === null) {
        // Redirigir con un error si faltan datos
        header("Location: " . BASE_URL . "GRUD/Crear/crearEscuela.php?error=campos_incompletos");
        exit();
    }

    // 4. Preparar la consulta SQL de inserción
    $sql = "INSERT INTO escuelas (nombre, idciudad) VALUES (?, ?)";

    try {
        $sentencia = $conn->prepare($sql);
        
        // 5. Ejecutar la sentencia
        // El orden de los parámetros debe coincidir con el orden de los '?' en el SQL
        $sentencia->execute([$nombre_escuela, $id_ciudad]);
        
        // 6. Redirigir al listado con un mensaje de éxito
        header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?creado=true");
        exit();
        
    } catch (PDOException $e) {
        // 7. Manejo de errores de base de datos
        // Redirigir con un error o mostrar mensaje
        // Para depuración, puedes usar: echo "Error: " . $e->getMessage();
        header("Location: " . BASE_URL . "GRUD/Crear/crearEscuela.php?error=db_fail");
        exit();
    }

} else {
    // Si alguien intenta acceder directamente al script sin enviar el formulario
    header("Location: ".BASE_URL . "GRUD/Leer/escuelas.php");
    exit();
}
?>