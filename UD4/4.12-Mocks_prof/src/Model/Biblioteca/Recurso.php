<?php
namespace App\Model\Biblioteca;
use App\Model\Biblioteca\Enum\EstadoRecurso;
use App\Service\Exportador;
use App\Service\Traits\Logger;
abstract class Recurso
{
    use Logger;
    protected string $titulo;
    protected Exportador $exportador;

    protected int $id;

    protected static int $contador = 0;

    protected EstadoRecurso $estado = EstadoRecurso::DISPONIBLE;

    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->id = ++self::$contador;
        $this->log("Se ha creado el recurso: " . $titulo . " con id: " . $this->id, "DEBUG", "app.log");
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

    public function isDisponible(): bool
    {
        return $this->estado === EstadoRecurso::DISPONIBLE;
    }

    public function setEstado(EstadoRecurso $estado): void
    {
        $this->estado = $estado;
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
     * Get the value of estado
     *
     * @return EstadoRecurso
     */
    public function getEstado(): EstadoRecurso
    {
        return $this->estado;
    }
}
