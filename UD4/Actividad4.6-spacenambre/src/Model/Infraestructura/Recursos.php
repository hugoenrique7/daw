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
}
