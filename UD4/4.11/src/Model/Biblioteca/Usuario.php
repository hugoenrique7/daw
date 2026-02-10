<?php

namespace App\Model\Biblioteca;

class Usuario
{
    private ?int $id;
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

    public function quitarPrestamo(int $idRecurso): bool
    {
        if (isset($this->prestamos[$idRecurso])) {
            unset($this->prestamos[$idRecurso]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     *
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }
}
