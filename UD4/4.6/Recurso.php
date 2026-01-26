<?php
abstract class Recurso
{
    use Logger;
    protected string $titulo;
    protected Exportador $exportador;


    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->log("Se ha creado el recurso: " . $titulo,null,"app");
    }

    abstract public function getTipo(): string;

    public abstract function getDescripcion(): string;


    public function setExportador(Exportador $exportador): void
    {
        $this->exportador = $exportador;
    }
    public function exportar(): string
    {
        return $this->exportador->exportar($this);
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
}
