<?php

namespace App\Model\Biblioteca;

use App\Model\Biblioteca\Recurso;
use App\Model\Biblioteca\Usuario;
use DateTimeImmutable;

class Prestamo
{
    private Usuario $cliente;
    private Recurso $recurso;
    private DateTimeImmutable $fechaPrestamo;
    private ?DateTimeImmutable $fechaDevolucion = null;
    public function __construct(
        Usuario $usuario,
        Recurso $recurso,
    ) {
        $this->cliente = $usuario;
        $this->recurso = $recurso;
        $this->fechaPrestamo = new DateTimeImmutable();
    }




    /**
     * Get the value of fechaPrestamo
     *
     * @return DateTimeImmutable
     */
    public function getFechaPrestamo(): DateTimeImmutable
    {
        return $this->fechaPrestamo;
    }

    /**
     * Set the value of fechaDevolucion
     *
     * @return  self
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;

        return $this;
    }

    /**
     * Get the value of recurso
     */
    public function getRecurso()
    {
        return $this->recurso;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario(): string
    {
        return $this->cliente->getEmail();
    }

    /**
     * Get the value of fechaDevolucion
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }
}
