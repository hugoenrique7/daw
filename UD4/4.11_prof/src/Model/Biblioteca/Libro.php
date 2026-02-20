<?php
namespace App\Model\Biblioteca;
class Libro extends Recurso {
    private string $isbn;

    public function __construct(
        string $titulo,
        string $isbn
    ) {
        parent::__construct($titulo);
        $this->isbn = $isbn;
    }

    public function getTipo(): string {
        return "Libro";
    }
public function getDescripcion(): string {
        return "Tipo: " . $this->getTipo() . ", Título: " . $this->titulo . ", ISBN: " . $this->isbn;
    }       
  
}