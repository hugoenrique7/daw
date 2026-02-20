<?php 
//require_once __DIR__.DIRECTORY_SEPARATOR."autoload.php";
require_once __DIR__.DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
use App\Model\Biblioteca\{  Libro, Usuario};
use App\Service\PrestamoService;




// Crear usuarios
$juan = new Usuario("Juan", "juan@email.com");
$maria = new Usuario("Maria", "maria@email.com");

// Crear recursos
$libro1 = new Libro("libro1", "b");
$libro2 = new Libro("libro2", "d");
$libro3 = new Libro("libro3", "f");
$libro4 = new Libro("libro4", "g"); // este no se podrá prestar a Juan, límite 3 préstamos

// Crear servicio de préstamos
$prestamos = new PrestamoService();
$prestamos->registrarUsuario($juan);
$prestamos->registrarUsuario($maria);
$prestamos->registrarRecurso($libro1);
$prestamos->registrarRecurso($libro2);
$prestamos->registrarRecurso($libro3);
$prestamos->registrarRecurso($libro4);

// Prestar recursos a Juan
try{
    $prestamo1 = $prestamos->prestar("juan@email.com", $libro1->getId());
    $prestamo2 = $prestamos->prestar("juan@email.com", $libro2->getId());
    $prestamo3 = $prestamos->prestar("juan@email.com", $libro3->getId());
    $prestamo4 = $prestamos->prestar("juan@email.com", $libro4->getId()); // devuelve false por límite de 3 préstamos
} catch (\Exception $e) {
  echo "Ha ocurrido un error al realizar el préstamo: " . $e->getMessage() . "<br/>";
}

echo "<h2>Préstamos de Juan:</h2>";
mostrarPrestamos($juan->getPrestamos());    
function mostrarPrestamos(array $prestamos): void {
    foreach ($prestamos as $prestamo) {
        echo $prestamo->getRecurso()->getTitulo() . " fecha de préstamo: " . $prestamo->getFechaPrestamo()->format('Y-m-d H:i:s') .   "<br/>";
    }   

}


$prestamos->devolverPrestamo($prestamo1);

echo "<h2>Préstamos de Juan tras devolver el primero:</h2>";
mostrarPrestamos($juan->getPrestamos());    

