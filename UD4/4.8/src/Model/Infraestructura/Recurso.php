<?php

namespace App\Model\Infraestructura;
//Recurso hardware
class Recurso
{
    private string $descripcion;

    public function __construct(string $descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get the value of descripcion
     *
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
}
