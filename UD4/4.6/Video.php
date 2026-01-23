<?php 

class Video extends Recurso {
    private int $duracion; // Duración en minutos

    public function __construct(
        string $titulo,
        int $duracion
    ) {
        parent::__construct($titulo);
        $this->duracion = $duracion;
    }

    public function getTipo(): string {
        return "Video";
    }

    public function getDescripcion(): string {
        return "Tipo: " . $this->getTipo() . ", Título: " . $this->titulo . ", Duración: " . $this->duracion . " minutos";
    }

/*
      public function exportar(): string
    {
         return json_encode([
            "tipo" => $this->getTipo(),
            "titulo" => $this->titulo,
            "duracion" => $this->duracion
        ], JSON_PRETTY_PRINT);
    }
*/
}