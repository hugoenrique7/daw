<?php

namespace App\Model\Biblioteca;

use App\Model\Biblioteca\Enum\EstadoRecurso;
use App\Service\Exportador;
use App\Service\Traits\Logger;


abstract class Recurso
{
    use Logger;
    public static int $CONTADOR_RECURSO = 0;


    private int $id;
    private string $titulo;

    private EstadoRecurso $estado;

    protected Exportador $exportador;

    public function __construct(string $titulo)
    {
        self::$CONTADOR_RECURSO++;
        $this->id = self::$CONTADOR_RECURSO;
        $this->titulo = $titulo;
        $this->log("Se ha creado el recurso: " . $titulo, "INFO");
        $this->estado = EstadoRecurso::DISPONIBLE;
    }
    public function isDisponible(): bool
    {
        return $this->estado === EstadoRecurso::DISPONIBLE;
    }
    abstract public function getTipo(): string;

    public abstract function getDescripcion(): string;

    public function exportar(): string
    {
        return $this->exportador->exportar($this);
    }


    /**
     * Set the value of exportador
     *
     * @param Exportador $exportador
     *
     * @return self
     */
    public function setExportador(Exportador $exportador): self
    {
        $this->exportador = $exportador;

        return $this;
    }

    /**
     * Get the value of titulo
     *
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
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
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado(EstadoRecurso $estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
