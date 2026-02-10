<?php
namespace App\Tests\Repository;
use PDO;

use PHPUnit\Framework\TestCase;
use App\Model\Biblioteca\Usuario;
use App\Repository\UsuarioRepository;


class UsuarioRepositoryTest extends TestCase
{
    private PDO $pdo;
    private UsuarioRepository $repository;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
         //Configuramos la conexión para que lance PDOExcepction en caso de error (no es necesario para versione PHP recientes)
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       //Creamos la/s tablas necesarias
        $this->crearEsquema();
        $this->repository = new UsuarioRepository($this->pdo);
    }

    private function crearEsquema(): void
    {
        $this->pdo->exec("
            CREATE TABLE usuarios (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                email TEXT NOT NULL
            )
        ");
    }

    public function testCrearYBuscarUsuario(): void
    {
        $usuario = new Usuario("Juan", "juan@example.com");

        $usuario = $this->repository->create($usuario);
        
        $this->assertNotNull($usuario);
        $this->assertNotNull($usuario->getId());

        $usuarioBD = $this->repository->findByEmail("juan@example.com");

        $this->assertNotNull($usuarioBD);
        $this->assertEquals("Juan", $usuarioBD->getNombre());
        $this->assertEquals("juan@example.com", $usuarioBD->getEmail());
        $this->assertEquals($usuario->getId(), $usuarioBD->getId());
    }
}
