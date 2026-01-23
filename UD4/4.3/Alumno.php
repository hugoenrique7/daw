<?php

class Alumno extends Persoa
{
    private $NumClases;
    public function __construct($nome, $apelidos, $mobil, $NumClases=null)
    {
        parent::__construct($nome, $apelidos, $mobil);
        $this->NumClases = $NumClases;
    }


    public function setNumClases($NumClases)
    {
        $this->NumClases = $NumClases;

        return $this;
    }

    public function aPagar()
    {
        $resultado = "<br>Alumno: " . $this->nome . " cota de : ";
        if (!isset($this->NumClases)) {
            return "<br>Debe indicar previamente o número de clases ";
        } elseif ($this->NumClases == 1) {
            return $resultado . "20 €";
        } elseif ($this->NumClases == 2) {
            return $resultado . "32 €";
        } else {
            return $resultado . "40 €";
        }
    }
}
