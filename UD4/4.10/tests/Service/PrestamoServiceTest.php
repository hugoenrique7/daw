<?php

namespace App\Tests\Service;

use Exception;
use App\Model\Biblioteca\Libro;
use PHPUnit\Framework\TestCase;
use App\Service\PrestamoService;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Enum\EstadoRecurso;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Video;

class PrestamoServiceTest extends TestCase
{

    private PrestamoService $service;
    private Libro $libro1;

    protected function setUp(): void
    {
        $this->service = new PrestamoService();
        $usuario = new Usuario("juan", "juan@example.com");
        // $libro = new Libro("Libro de prueba", "Autor de prueba");
        $this->libro1 = new Libro("Libro de prueba", "Autor de prueba");

        $this->service->registrarUsuario($usuario);
        $this->service->registrarRecurso($this->libro1);
    }

    public function testPrestarRecursoDisponible(): void
    {

        $prestamo = $this->service->prestar("juan@example.com", 1);

        $this->assertEquals(EstadoRecurso::PRESTADO, $prestamo->getRecurso()->getEstado());
    }


    public function testPrestarRecursoIncrementaContadorUsuario()
    {
        $email = "juan@example.com";
        $idRecurso = $this->libro1->getId();
        $usuarioBuscado = $this->service->buscarUsuario($email);
        $totalInicial = count($usuarioBuscado->getPrestamos());
        $this->service->prestar($email, $idRecurso);
        $this->assertEquals(
            $totalInicial + 1,
            count($usuarioBuscado->getPrestamos()),
            "El número de préstamos debería haber aumentado en 1."
        );
        /*
    $this->assertEquals(EstadoRecurso::PRESTADO, $usuario->getPrestamos()[0]->getRecurso()->getEstado());
  */
    }



    public function testUsuarioNoEncontradoLanzaExcepcion(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Usuario no encontrado");

        $this->service->prestar("inexistente", 1);
    }

    public function testPrestamoNoEncontradoLanzaExcepcion()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("El recurso no existe");

        $this->service->prestar("juan@example.com", 454);
    }

    public function testPrestamoSuperarLimiteLanzaExcepcion()
    {
        $libro2 = new Libro("libro2", "juan@example2.com");
        $revista3 = new Revista("libro3", 514);
        $video4 = new Video("libro4", 4584);

        $this->service->registrarRecurso($libro2);
        $this->service->registrarRecurso($revista3);
        $this->service->registrarRecurso($video4);

        $this->service->prestar("juan@example.com", $this->libro1->getId());
        $this->service->prestar("juan@example.com", $libro2->getId());
        $this->service->prestar("juan@example.com", $revista3->getId());

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("El usuario tiene mas de 3 recursos prestado");



        $this->service->prestar("juan@example.com", $video4->getId());
    }


    public function testPrestimoDevolverPrestamo()
    {

        $usuarioBuscado = $this->service->buscarUsuario("juan@example.com");


        $objPrestimo = $this->service->prestar("juan@example.com", $this->libro1->getId());
        $totalPrestamo = count($usuarioBuscado->getPrestamos());

        $this->service->devolverPrestamo($objPrestimo);

        $this->assertEquals(
            $totalPrestamo - 1,
            count($usuarioBuscado->getPrestamos()),
            "El número de préstamos debería haber restado Uno ."
        );

        $this->assertEquals(EstadoRecurso::DISPONIBLE, $objPrestimo->getRecurso()->getEstado(), "El recurso sigue prestado");
    }

    public function testNoSePuedePrestarRecursoYaPrestado()
    {



        $this->service->prestar("juan@example.com", $this->libro1->getId());

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("El recurso ya está prestado");

        $this->service->prestar("juan@example.com", $this->libro1->getId());
    }

    public function testBuscarUsuarioNoEncontrado()
    {

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Usuario no encontrado");
        $this->service->buscarUsuario("noencontrado@example.com");
    }
   
}
