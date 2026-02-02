<?php
require_once __DIR__ . '/autoload.php';


use App\Service\Traits\Logger;
use App\Service\Exportador;
use App\Service\ExportadorTexto;
use App\Service\ExportadorJSON;
use App\Service\ExportadorXML;
use App\Model\Biblioteca\Recurso;
use App\Model\Infraestructura\Recurso as RecursoInfra;
use App\Model\Biblioteca\Libro;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Video;
use App\Service\PrestamoService;

$juan = new Usuario("Juan", "juan@email.com");
$maria = new Usuario("Maria", "maria@email.com");

$libro1 = new Libro("libro1", "b");
$libro2 = new Libro("libro2", "d");
$libro3 = new Libro("libro3", "f");
$libro4 = new Libro("libro4", "g");

// Crear servicio de préstamos
$prestamos = new PrestamoService();
$prestamos->registrarUsuario($juan);
$prestamos->registrarUsuario($maria);

$prestamos->registrarRecurso($libro1);
$prestamos->registrarRecurso($libro2);
$prestamos->registrarRecurso($libro3);
$prestamos->registrarRecurso($libro4);


// Prestar recursos a Juan
try {
    $prestamo1 = $prestamos->prestar("juan@email.com", $libro1->getId());
    $prestamo2 = $prestamos->prestar("juan@email.com", $libro2->getId());
    $prestamo3 = $prestamos->prestar("juan@email.com", $libro3->getId());
    // $prestamo4 = $prestamos->prestar("juan@email.com", $libro4->getId()); // devuelve false por límite de 3 préstamos

} catch (\Exception $e) {
    echo "Ha ocurrido un error al realizar el préstamo: " . $e->getMessage() . "<br/>";
}



echo "<h3>Préstamos de Juan:</h3>";

foreach ($juan->getPrestamos() as $key => $p) {
    if ($p !== null) {
        echo $p->getRecurso()->getTitulo()  . " fecha de préstamo: " . $p->getFechaPrestamo()->format('Y-m-d H:i:s') .   "<br/>";
    }
}



$prestamos->devolverPrestamo($prestamo1);


echo "<h3>Préstamos Activos de Juan:</h3>";


foreach ($juan->getPrestamos() as $key => $p) {
    if ($p !== null) {
        echo $p->getRecurso()->getTitulo()  . " fecha de préstamo: " . $p->getFechaPrestamo()->format('Y-m-d H:i:s') .   "<br/>";
    }
}
echo $prestamo1->getFechaDevolucion()->format('Y-m-d H:i:s');
