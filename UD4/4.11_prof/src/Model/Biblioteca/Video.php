<?php
namespace App\Model\Biblioteca;

class Video extends Recurso
{
    private int $duracion; // Duración en minutos
    //Recursos de infraestructura
    private array $recursos = [];

    public function __construct(
        string $titulo,
        int $duracion
    ) {
        parent::__construct($titulo);
        $this->duracion = $duracion;
        $this->log("Video creado: {$titulo}, duración {$duracion} min");
    }



    public function getTipo(): string
    {
        return "Video";
    }

    public function getDescripcion(): string
    {
        return "Tipo: " . $this->getTipo() . ", Título: " . $this->titulo . ", Duración: " . $this->duracion . " minutos";
    }

    /**
     * Get the value of recursos
     *
     * @return array
     */
    public function getRecursos(): array
    {
        return $this->recursos;
    }

    // public function agregarRecurso(RecursoInfra $recurso): void
    // {
    //     $this->recursos[] = $recurso;
    //     $this->log("Recurso agregado al video '{$this->titulo}': {$recurso->getDescripcion()}");
    // }

    
     public function agregarRecurso(\App\Model\Infraestructura\Recurso $recurso): void
    {
        $this->recursos[] = $recurso;
        $this->log("Recurso agregado al video '{$this->titulo}': {$recurso->getDescripcion()}");
    }
}
