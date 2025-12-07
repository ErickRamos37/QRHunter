<?php
    // Define la constante RUTA_RAIZ con la ruta absoluta al directorio raíz del proyecto (QRHunter).
    // Se utiliza en el backend (PHP) para incluir o requerir archivos.
    // dirname(__DIR__) sube un nivel desde el directorio del archivo actual.
    define("RUTA_RAIZ", dirname(__DIR__));

    // Define la constante BASE_URL. Es la ruta base para el acceso en el frontend (navegador/HTML).
    // Debe coincidir con el alias o subdirectorio configurado en el servidor web.
    define("BASE_URL", "/QRHunter/");
    
    // Define la constante RUTA_CSS. Es la ruta de acceso en el frontend (HTML) al directorio de estilos CSS.
    // Se usa para enlazar correctamente las hojas de estilo en las vistas.
    define("RUTA_CSS", "/QRHunter/views/css/");
?>