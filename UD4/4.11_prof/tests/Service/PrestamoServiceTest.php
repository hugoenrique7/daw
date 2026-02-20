<?php

namespace App\Tests\Service;

use Exception;
use App\Model\Biblioteca\Libro;
use App\Model\Biblioteca\Video;
use PHPUnit\Framework\TestCase;
use App\Service\PrestamoService;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Enum\EstadoRecurso;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class PrestamoServiceTest extends TestCase
{
  // public function testDummy() {
  //   $this->assertTrue(true);
  // }

  private PrestamoService $service;
  private Libro $libro1;
  private Revista $revista2;
  private Video $video3;
  protected function setUp(): void
  {
    $this->service = new PrestamoService();
    $usuario = new Usuario("juan", "juan@example.com");
    $this->libro1 = new Libro("Libro de prueba", "Autor de prueba");
    $this->revista2 = new Revista("Título", 1000);
    $this->video3 = new Video("Vídeo", 120);


    $this->service->registrarUsuario($usuario);
    $this->service->registrarRecurso($this->libro1);
    $this->service->registrarRecurso($this->revista2);
    $this->service->registrarRecurso($this->video3);
  }

  public function testPrestarRecursoDisponible(): void
  {
    $usuario = $this->service->getUsuarioByEmail("juan@example.com");
    //Sabemos que $usuario no es null 
    $contadorPrestamosAntesDePrestar = count($usuario->getPrestamos());
    $prestamo = $this->service->prestar("juan@example.com", $this->libro1->getId());
    $this->assertEquals(EstadoRecurso::PRESTADO, $prestamo->getRecurso()->getEstado());
    $this->assertEquals(
      $contadorPrestamosAntesDePrestar + 1,
      count($prestamo->getUsuario()->getPrestamos())
    );
  }

  public function testUsuarioNoEncontradoLanzaExcepcion(): void
  {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Usuario no encontrado");

    $this->service->prestar("inexistente", $this->libro1->getId());
  }

  public function testRecursoNoEncontradoLanzaExcepcion(): void
  {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Recurso no encontrado");

    $this->service->prestar("juan@example.com", 999);
  }

  public function testPrestarRecursoPrestadoLanzaExcepcion(): void
  {
    $this->service->prestar("juan@example.com", $this->libro1->getId());

    $ana = new Usuario("Ana", "ana@example.com");
    $this->service->registrarUsuario($ana);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Recurso no disponible");

    $this->service->prestar("ana@example.com", $this->libro1->getId());
  }

  public function testPrestarMasDeMaxPrestamosLanzaExcepcion()
  {
    $this->service->prestar("juan@example.com", $this->libro1->getId());
    $this->service->prestar("juan@example.com", $this->revista2->getId());
    $this->service->prestar("juan@example.com", $this->video3->getId());

    $revista4 = new Revista("Título 4", 1004);
    $this->service->registrarRecurso($revista4);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage("El usuario ha alcanzado el máximo de préstamos");

    $this->service->prestar("juan@example.com", $revista4->getId());
  }

  public function testDevolverPrestamoConExito()
  {
    $usuario = $this->service->getUsuarioByEmail("juan@example.com");
    $prestamo = $this->service->prestar("juan@example.com", $this->video3->getId());
    $numPrestamosAntesDeDevolver = count($usuario->getPrestamos());

    $this->service->devolverPrestamo($prestamo);

    $numPrestamosDespues = count($usuario->getPrestamos());

    $this->assertEquals($numPrestamosAntesDeDevolver - 1, $numPrestamosDespues);
    $this->assertEquals(EstadoRecurso::DISPONIBLE, $prestamo->getRecurso()->getEstado());
  }

  public function testUsuarioByEmailNoEncontrado(): void
  {
    $usuario = $this->service->getUsuarioByEmail('inexistente');
    $this->assertNull($usuario);
  }
}
