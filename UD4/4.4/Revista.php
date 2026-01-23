<?php

class Revista extends Recurso {
    private int $numero;

    public function __construct(
        string $titulo,
        int $numero
    ) {
        parent::__construct($titulo);
        $this->numero = $numero;
    }

    public function getTipo(): string {
        return "Revista";
    }
}



