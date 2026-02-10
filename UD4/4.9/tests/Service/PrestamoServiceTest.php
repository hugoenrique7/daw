<?php
namespace App\Tests\Service;
use Exception;
use App\Model\Biblioteca\Libro;
use PHPUnit\Framework\TestCase;
use App\Service\PrestamoService;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Enum\EstadoRecurso;

class PrestamoServiceTest extends TestCase
{
   
    private PrestamoService $service;

    protected function setUp(): void {
        $this->service = new PrestamoService();
        $usuario = new Usuario("juan", "juan@example.com");
        $libro = new Libro("Libro de prueba", "Autor de prueba");

        $this->service->registrarUsuario($usuario);
        $this->service->registrarRecurso($libro);
    }

    public function testPrestarRecursoDisponible(): void {
        //usuario

        //len de usuario presto+1
        
         if (count($this->usuarios[$emailUsuario]->getPrestamos()) > 3) {
            }

        $this->assertEquals(EstadoRecurso::PRESTADO, $this->usuarios[$emailUsuario]->getPrestamos());

        $prestamo = $this->service->prestar("juan@example.com", 1);

        $this->assertEquals(EstadoRecurso::PRESTADO, $prestamo->getRecurso()->getEstado());
    }

    public function testUsuarioNoEncontradoLanzaExcepcion(): void {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Usuario no encontrado");

        $this->service->prestar("inexistente", 1);
    }

  
}