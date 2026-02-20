<?php
namespace App\Model\Infraestructura;
//Recurso hardware

class Recurso{
    private string $descripcion;
 

    public function __construct(string $descripcion) {
      
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

    /**
     * Set the value of descripcion
     *
     * @param string $descripcion
     *
     * @return self
     */
    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}