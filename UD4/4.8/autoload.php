
<?php
// Namespace raíz del proyecto
const APP_NAMESPACE_BASE = 'App\\';
// Directorio base del proyecto
const APP_DIRECTORIO_BASE = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

spl_autoload_register(function (string $nombreClase) {

    // Normalizamos el nombre en el caso de que empiece con \
    $nombreClase = ltrim($nombreClase, '\\');

    // Si la clase NO empieza por App\, no es de nuestra aplicación
    if (strpos($nombreClase, APP_NAMESPACE_BASE) !== 0) {
        return;
    }

    // Quitamos "App\" del inicio del namespace
    $rutaRelativa = substr($nombreClase, strlen(APP_NAMESPACE_BASE));

    // Sustituimos \ por DIRECTORY_SEPARATOR para construir la ruta
    $rutaRelativa = str_replace('\\', DIRECTORY_SEPARATOR, $rutaRelativa);

    // Archivo final
    $archivo = APP_DIRECTORIO_BASE . $rutaRelativa . '.php';

    // Si existe, lo cargamos
    if (file_exists($archivo)) {
        require_once $archivo;
    }
});
