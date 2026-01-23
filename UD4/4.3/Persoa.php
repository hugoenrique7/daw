<?php

class Persoa
{
    public string $nome;

    public string $apelidos;

    public string $mobil;

    public function __construct($nome, $apelidos, $mobil)
    {
        $this->nome = $nome;
        $this->apelidos = $apelidos;
        $this->mobil = $mobil;
    }



    public function verInformacion()
    {

        return "" . $this->nome . " (" . $this->mobil . ") <br>";
    }
}
