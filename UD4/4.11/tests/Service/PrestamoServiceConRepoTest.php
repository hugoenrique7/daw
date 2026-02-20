<?php

use PDO;
use App\Model\Biblioteca\Libro;
use App\Model\Biblioteca\Video;
use PHPUnit\Framework\TestCase;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Usuario;
use App\Repository\UsuarioRepository;
use App\Service\PrestamoServiceConRepo;
use App\Model\Biblioteca\Enum\EstadoRecurso;

class PrestamoServiceConRepoTest extends TestCase
{

    //Renombramos el tipo de la propiedad del servicio para que use la clase PrestamoServiceConRepo
    private PrestamoServiceConRepo $service;
    private Libro $libro1;
    private Video $video2;
    private Revista $revista3;
    private Usuario $usuario;

    //Añadimos las dependencias de PDO y del repo en forma de atributos de la clase de Test
    private PDO $pdo;

    private  $usuarioRepository;

    /**
     * Inicializa el servicio de préstamo y registra un usuario y un recurso de prueba.
     * Se ejecuta antes de cada prueba.
     * @return void
     */
    protected function setUp(): void
    {
        //Creamos una conexión PDO a una base de datos en memoria con SQLite
        $this->pdo = new PDO('sqlite::memory:');
        //Creamos un objeto Mock que imite el UsuarioRepository
        $this->usuarioRepository = $this->createMock(UsuarioRepository::class);

        $this->service = new PrestamoServiceConRepo($this->usuarioRepository);

        $this->usuario = new Usuario("juan", "juan@example.com");
        $this->libro1 = new Libro("Libro de prueba", "Autor de prueba");
        $this->video2 = new Video("Video de prueba", 120);
        $this->revista3 = new Revista("Revista de prueba", 45);
        //stub 
        //No usar expectativas en setUp por regla general
        $this->usuarioRepository
            ->method('create')
            ->willReturn($this->usuario)
            ->with($this->usuario);

        $this->usuario = $this->service->registrarUsuario($this->usuario);

        $this->service->registrarRecurso($this->libro1);
        $this->service->registrarRecurso($this->video2);
        $this->service->registrarRecurso($this->revista3);
    }
    /**
     * Comprueba que un recurso disponible se puede prestar a un usuario sin préstamos
     * @return void
     */
    public function testPrestarRecursoDisponible(): void
    {/*
        $this->usuarioRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with($this->usuario->getEmail())
            ->willReturn($this->usuario);
            */
        $prestamosAntes = $this->usuario->getPrestamos();

        //antes de llamar al método prestar, crearemos el mock y definiremos su comportamiento
        $this->usuarioRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with($this->usuario->getEmail())
            ->willReturn($this->usuario);

        $prestamo = $this->service->prestar($this->usuario->getEmail(), $this->libro1->getId());
        $this->assertEquals(EstadoRecurso::PRESTADO, $prestamo->getRecurso()->getEstado());
        //nuevo
        $this->assertCount(count($prestamosAntes) + 1, $prestamo->getCliente()->getPrestamos());
    }


    // Más métodos



}
