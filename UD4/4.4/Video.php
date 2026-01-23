<?php

class Video extends Recurso
{

    private $duracion;



    public function __construct(string $titulo, int $duracion)
    {
        parent::__construct($titulo);
        $this->duracion = $duracion;
    }
    public function getTipo(): string
    {
        return "Video";
    }


    public function getDescripcion(): string
    {
        return "Titulo: " . $this->titulo . " | Duración: " . $this->duracion;
    }
}
