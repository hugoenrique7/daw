<?php

abstract class Recurso {
    protected string $titulo;

    public function __construct(string $titulo) {
        $this->titulo = $titulo;
    }

    abstract public function getTipo(): string;
    abstract public function getDescripcion():string;

    
}

