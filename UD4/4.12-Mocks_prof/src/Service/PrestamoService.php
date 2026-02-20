<?php
namespace App\Service;
use App\Model\Biblioteca\Enum\EstadoRecurso;
use App\Model\Biblioteca\Prestamo;
use App\Model\Biblioteca\Usuario;
use App\Model\Biblioteca\Recurso;
use App\Service\Traits\Logger;
class PrestamoService
{
    use Logger;
    private array $usuarios = [];
    private array $recursos = [];
    private const MAX_PRESTAMOS = 3;

    public function prestar(string $nombreUsuario, int $idRecurso): Prestamo
    {

        if (!isset($this->usuarios[$nombreUsuario])) {
            $this->log("Usuario no encontrado: " . $nombreUsuario, "ERROR", "app.log");
            throw new \Exception("Usuario no encontrado");
        }

        if (!isset($this->recursos[$idRecurso])) {
            $this->log("Recurso no encontrado: " . $idRecurso, "ERROR", "app.log");
            throw new \Exception("Recurso no encontrado");
        }
        //Si llegamos aquí, es que el usuario y el recurso existen
        $usuario = $this->usuarios[$nombreUsuario];
        $recurso = $this->recursos[$idRecurso];

        if (!$recurso->isDisponible()) {
            $this->log("Recurso no disponible: " . $idRecurso, "ERROR", "app.log");
            throw new \Exception("Recurso no disponible");
        }
        if (count($usuario->getPrestamos()) >= self::MAX_PRESTAMOS) {
            $this->log("Usuario ha alcanzado el máximo de préstamos: " . $nombreUsuario, "ERROR", "app.log");
            throw new \Exception("El usuario ha alcanzado el máximo de préstamos");
        }
        //Realizar el préstamo

        $prestamo = new Prestamo($recurso, $usuario);
        $recurso->setEstado(EstadoRecurso::PRESTADO);
        $usuario->addPrestamo($prestamo);
        return $prestamo;
    }

    //To do : Indicar que los arrays son de tipo Usuario y Recurso y son asociativos por email e id respectivamente
    //Crea los getters y setters imprescindibles para que tu código funcione
    public function registrarUsuario(Usuario $usuario): void
    {
        $this->usuarios[$usuario->getEmail()] = $usuario;
    }

    public function registrarRecurso(Recurso $recurso): void
    {
        $this->recursos[$recurso->getId()] = $recurso;
    }

    public function devolverPrestamo(Prestamo $prestamo): void
    {
        $prestamo->setFechaDevolucion(new \DateTimeImmutable());
        $prestamo->getRecurso()->setEstado(EstadoRecurso::DISPONIBLE);
        $prestamo->getUsuario()->removePrestamo($prestamo);
    }

    public function getUsuarioByEmail(string $email):?Usuario{
        if(isset($this->usuarios[$email])){
            return $this->usuarios[$email];
        }
        return null;
    }
}