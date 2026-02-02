<?php

namespace App\Model\Biblioteca;

class Usuario
{
    protected string $nombre;
    protected string $email;
    protected array $prestamos = [];



    public $property;

    public function __construct($nombre, $email, $prestamos = null)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->prestamos[] = $prestamos;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the value of prestamos
     */
    public function getPrestamos()
    {
        return $this->prestamos;
    }

    /**
     * Set the value of prestamos
     *
     * @return  self
     */
    public function setPrestamos(int $id, PRESTAMO $prestamos)
    {
        $this->prestamos[$id] = $prestamos;

        return $this;
    }

    public function quitarPrestamo(int $idRecurso): void
    {
        if (isset($this->prestamos[$idRecurso])) {
            unset($this->prestamos[$idRecurso]);
        }
    }
}
