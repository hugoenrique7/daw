<?php 
namespace App\Model\Biblioteca;
use App\Model\Biblioteca\Enum\EstadoRecurso;
class Prestamo
{
    private Recurso $recurso;
    private Usuario $usuario;
    private \DateTimeImmutable $fechaPrestamo;
    private ?\DateTimeImmutable $fechaDevolucion = null;

    public function __construct(Recurso $recurso, Usuario $usuario)
    {
        if ($recurso->getEstado() !== EstadoRecurso::DISPONIBLE) {
            throw new \Exception('Recurso no disponible');
        }

        $this->recurso = $recurso;
        $this->usuario = $usuario;
        $this->fechaPrestamo = new \DateTimeImmutable();


    }




    /**
     * Set the value of fechaDevolucion
     *
     * @param ?\DateTimeImmutable $fechaDevolucion
     *
     * @return self
     */
    public function setFechaDevolucion(?\DateTimeImmutable $fechaDevolucion): self
    {
        $this->fechaDevolucion = $fechaDevolucion;

        return $this;
    }


    public function getRecurso(): Recurso
    {
        return $this->recurso;
    }

    /**
     * Get the value of usuario
     *
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * Get the value of fechaPrestamo
     *
     * @return \DateTimeImmutable
     */
    public function getFechaPrestamo(): \DateTimeImmutable
    {
        return $this->fechaPrestamo;
    }
}
