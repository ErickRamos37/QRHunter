<?php
// La inclusión requiere subir dos niveles (../../) para llegar a la raíz (QRHunter/)
// y encontrar la carpeta 'config'.
require_once("../../config/config.php");
require_once(RUTA_RAIZ."/config/conexion.php"); 
<<<<<<< HEAD
// Nota: header.php no es estrictamente necesario en este script de procesamiento, pero lo incluimos por consistencia.
require_once(RUTA_RAIZ."/views/header.php");
$conn = conectarBD();

// Recibe los datos del formulario (crearEscuela.php)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Si no es POST, redirige con error (o simplemente al listado)
    header("location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=metodo_no_valido");
    exit();
}

// Validación básica de datos
$nombre = $_POST["nombre"] ?? null;
$idciudad = $_POST["idciudad"] ?? null;

if (empty($nombre) || empty($idciudad)) {
    header("location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=datos_faltantes");
    exit();
}

// Sentencia SQL para la inserción
// Se incluye NOW() para la columna fecha_registro
$sql = "INSERT INTO escuelas(nombre, idciudad, fecha_registro) VALUES (?, ?, NOW())";
=======
require_once(RUTA_RAIZ."/views/header.php"); // Puedes considerar eliminar esta línea si no se usa HTML.
$conn = conectarBD();

// Obtener el ID de la escuela de la URL (Método GET)
if (isset($_GET["id_escuela"])) {
    $id_escuela = $_GET["id_escuela"];
} else {
    // Si no hay ID, redirige al listado con un error
    header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=no_id");
    exit();
}

// Sentencia DELETE: Elimina la fila basada en el id_escuela
$sql = "DELETE FROM escuelas WHERE id_escuela = ?";
>>>>>>> 50e17e236b63f8e473c59206caded78eaae6487f

try {
    $sentencia = $conn->prepare($sql);
    
<<<<<<< HEAD
    // Ejecutar la sentencia con los parámetros recibidos
    $sentencia->execute([$nombre, $idciudad]);

    // Redirección exitosa: Usando BASE_URL para volver al listado de escuelas
    header("location: " . BASE_URL . "GRUD/Leer/escuelas.php?insertado=true");
    exit();
    
} catch (PDOException $e) {
    // Si falla la inserción (ej: clave foránea inválida o duplicado)
    echo "<h1>Error al insertar la escuela</h1>";
    echo "<h2>Detalles Técnicos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
=======
    // Ejecutar la sentencia con el ID de la escuela
    $sentencia->execute([$id_escuela]);
    
    // Redirige al listado: Usando BASE_URL para volver al listado de escuelas 
    // y pasar un parámetro de confirmación.
   header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?eliminado=true");

    exit();
    
} catch (PDOException $e) {
    // Manejo del error: Si hay una restricción de clave foránea (FK)
    // (ejemplo: si hay alumnos registrados en esta escuela)
    if ($e->getCode() == '23000') {
        // Error de integridad referencial (Foreign Key Constraint)
       header("Location: " . BASE_URL . "GRUD/Leer/escuelas.php?error=fk_alumnos");
        exit();
    } else {
        // Otros errores de base de datos.
        // Se recomienda redirigir a una página de error o mostrar un mensaje.
        echo "<h1>Error al eliminar los datos</h1>";
        echo "<h2>Detalles Técnicos:</h2>";
        echo "<p>" . $e->getMessage() . "</p>";
    }
>>>>>>> 50e17e236b63f8e473c59206caded78eaae6487f
}
?>