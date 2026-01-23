<?php
class Baile
{
    const  MIN_EDAD=8;

    private string $nome;
    private int $idadeMinima;

    public function __construct($nome, $idadeMinima = SELF::MIN_EDAD)
    {
        $this->nome = $nome;
        $this->idadeMinima = $idadeMinima;
    }


    /**
     * Set the value of nome
     *
     * @param string $nome
     *
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of nome
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Get the value of idadeMinima
     *
     * @return int
     */
    public function getIdadeMinima(): int
    {
        return $this->idadeMinima;
    }
}
