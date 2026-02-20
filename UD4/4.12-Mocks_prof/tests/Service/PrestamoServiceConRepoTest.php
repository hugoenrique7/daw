<?php

namespace App\Tests\Service;

use App\Repository\UsuarioRepository;
use Exception;
use App\Model\Biblioteca\Libro;
use App\Model\Biblioteca\Video;
use PHPUnit\Framework\TestCase;
use App\Service\PrestamoServiceConRepo;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Enum\EstadoRecurso;



class PrestamoServiceConRepoTest extends TestCase
{
  // public function testDummy() {
  //   $this->assertTrue(true);
  // }

  private PrestamoServiceConRepo $service;
  private UsuarioRepository $usuarioRepository;
  private Libro $libro1;
  private Revista $revista2;
  private Video $video3;

  private Usuario $usuario;
  protected function setUp(): void
  {

    $this->usuarioRepository = $this->createMock(UsuarioRepository::class);
    $this->service = new PrestamoServiceConRepo($this->usuarioRepository);

    $this->usuario = new Usuario("juan", "juan@example.com");
    $this->libro1 = new Libro("Libro de prueba", "Autor de prueba");
    $this->revista2 = new Revista("Título", 1000);
    $this->video3 = new Video("Vídeo", 120);


    //stub 
    //No usar expectativas en setUp por regla general
    /*
    $this->usuarioRepository
      ->method('create')
      ->willReturn($this->usuario)
      ->with($this->usuario);
*/
    $this->usuarioRepository
      ->method('create')
      ->willReturnArgument(0);

    $this->usuario = $this->service->registrarUsuario($this->usuario);


    $this->service->registrarRecurso($this->libro1);
    $this->service->registrarRecurso($this->revista2);
    $this->service->registrarRecurso($this->video3);
  }

  public function testPrestarRecursoDisponible(): void
  {

    //antes de llamar al método prestar, crearemos el mock y definiremos su comportamiento
    $this->usuarioRepository
      ->expects($this->exactly(2))
      ->method('findByEmail')
      ->with($this->usuario->getEmail())
      ->willReturn($this->usuario);
    //getUsuarioByEmail también hace uso de findByEmail, por eso esperamos que se llame exactamente 2 veces a este método
    $usuario = $this->service->getUsuarioByEmail($this->usuario->getEmail());
    //Sabemos que $usuario no es null 
    $contadorPrestamosAntesDePrestar = count($usuario->getPrestamos());


    $prestamo = $this->service->prestar($this->usuario->getEmail(), $this->libro1->getId());
    //Comprobamos que el estado del recurso es PRESTADO y que el número de préstamos del usuario ha aumentado en 1
    $this->assertEquals(EstadoRecurso::PRESTADO, $prestamo->getRecurso()->getEstado());
    $this->assertEquals(
      $contadorPrestamosAntesDePrestar + 1,
      count($prestamo->getUsuario()->getPrestamos())
    );
  }

  public function testUsuarioNoEncontradoLanzaExcepcion(): void

  {
    $this->usuarioRepository
      ->expects($this->exactly(1))
      ->method('findByEmail')
      ->with("inexistente")
      ->willReturn(null);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Usuario no encontrado");

    $this->service->prestar("inexistente", $this->libro1->getId());
  }

  public function testRecursoNoEncontradoLanzaExcepcion(): void
  {
    $this->usuarioRepository
      ->expects($this->once())
      ->method('findByEmail')
      ->with($this->usuario->getEmail())
      ->willReturn($this->usuario);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Recurso no encontrado");

    $this->service->prestar("juan@example.com", idRecurso: 999);
  }

  public function testPrestarRecursoPrestadoLanzaExcepcion(): void
  {

    $ana=  new Usuario("ana", "ana@example.com");
    $this->usuarioRepository
      ->method("findByEmail")
      ->willReturnMap([
        ["juan@example.com", $this->usuario],
        ["ana@example.com", $ana],
      ]);
    /*
    $this->usuarioRepository
      ->expects($this->once())
      ->method('findByEmail')
      ->with($this->usuario->getEmail())
      ->willReturn($this->usuario);
*/
    $this->service->prestar("juan@example.com", $this->libro1->getId());



    /*
    $ana = new Usuario("Ana", "ana@example.com");
    $this->usuarioRepository
      ->expects($this->once())
      ->method('create')
      ->with($ana)
      ->willReturn($ana);

*/
    $this->service->registrarUsuario($ana);






    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Recurso no disponible");

    $this->usuarioRepository
      ->expects($this->once())
      ->method('findByEmail')
      ->with("ana@example.com")
      ->willReturn($ana);

    $this->service->prestar("ana@example.com", $this->libro1->getId());
  }

  public function testPrestarMasDeMaxPrestamosLanzaExcepcion()
  {
    $this->usuarioRepository
      ->expects($this->exactly(4))
      ->method('findByEmail')
      ->with("juan@example.com")
      ->willReturn($this->usuario);

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

    $this->usuarioRepository
      ->expects($this->exactly(2))
      ->method('findByEmail')
      ->with("juan@example.com")
      ->willReturn($this->usuario);
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
