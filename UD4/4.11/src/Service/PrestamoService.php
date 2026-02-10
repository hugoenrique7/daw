<?php


namespace App\Service;

use App\Model\Biblioteca\Enum\EstadoRecurso;
use App\Model\Biblioteca\Prestamo;
use App\Model\Biblioteca\Recurso;
use App\Model\Biblioteca\Usuario;
use App\Service\Traits\Logger;
use Exception;
use DateTimeImmutable;

class PrestamoService
{

    use Logger;

    private array $recursos = [];
    private array $usuarios = [];


    public function registrarUsuario(Usuario $usuario)
    {
        try {
            if (array_key_exists($usuario->getEmail(), $this->usuarios)) {
                throw new Exception("El usuario: {$usuario->getEmail()} ya existe");
            }
            $this->usuarios[$usuario->getEmail()] = $usuario;
            return true;
        } catch (Exception $e) {
            $this->log($e->getMessage(), "INFO", "Pservice");
            return false;
        }
    }


    public function registrarRecurso(Recurso $recurso)
    {
        try {
            if (array_key_exists($recurso->getId(), $this->recursos)) {
                throw new Exception("El {$recurso->getTipo()} ID: {$recurso->getId()} ya existe");
            }
            if (!$recurso->isDisponible()) {
                throw new Exception("El {$recurso->getTipo()} ID: {$recurso->getId()} no está disponible");
            }
            $this->recursos[$recurso->getId()] = $recurso;
            return true;
        } catch (Exception $q) {
            $this->log($q->getMessage(), "INFO", "Pservice");
            return false;
        }
    }





    public function prestar(string $emailUsuario, int $idRecurso)
    {
        try {

            if (!isset($this->usuarios[$emailUsuario])) {
                throw new Exception("Usuario no encontrado");
            }

            if (!isset($this->recursos[$idRecurso])) {
                throw new Exception("El recurso no existe");
            }


            if (!$this->recursos[$idRecurso]->isDisponible()) {
                throw new Exception("El recurso ya está prestado");
            }

            if (count($this->usuarios[$emailUsuario]->getPrestamos()) > 3) {
                throw new Exception("El usuario tiene mas de 3 recursos prestado");
            }

            $objetoPrestamo = new Prestamo($this->usuarios[$emailUsuario], $this->recursos[$idRecurso]);
            $this->recursos[$idRecurso]->setEstado(EstadoRecurso::PRESTADO);
            $this->usuarios[$emailUsuario]->setPrestamos($idRecurso, $objetoPrestamo);

            return $objetoPrestamo;
        } catch (Exception $q) {
            $this->log($q->getMessage(), "INFO", "Pservice");
            throw $q;
        }
    }




    public function devolverPrestamo(Prestamo $prestamo)
    {
        $idRecurso = $prestamo->getRecurso()->getId();
        $email = $prestamo->getUsuario();
        $devolucion = new DateTimeImmutable();
        $prestamo->setFechaDevolucion($devolucion);
        $this->recursos[$idRecurso]->setEstado(EstadoRecurso::DISPONIBLE);
        $this->usuarios[$email]->quitarPrestamo($idRecurso);


        return $this;
    }

    /**
     * Get the value of usuarios
     */
    public function buscarUsuario(string $usuario): Usuario
    {
        if (!isset($this->usuarios[$usuario])) {
            throw new Exception("Usuario no encontrado");
            
        }
        return $this->usuarios[$usuario];
    }
}
