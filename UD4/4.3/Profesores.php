<?php
class Profesores extends Persoa
{
    const VHORA=16;
    private $nif;
    private $listaClases = [];

    public function __construct(string $nome,string $apelidos,string $mobil,string $nif)
    {
        parent::__construct($nome, $apelidos, $mobil);
        $this->nif = $nif;
    }

    public static function calcularSoldo($Nhoras, $ValorHora =self::VHORA)
    {
        $valortotal = $Nhoras * $ValorHora;
        return "Soldo: {$valortotal} Euros <br>";
    }


    public function engadirBailes(Baile $bailes)
    {
        if (isset($this->listaClases)) {
            foreach ($this->listaClases as $value) {

                if ($value->getNome() == $bailes->getNome()) {
                    return false;
                }
            }
            $this->listaClases[] = $bailes;
            return true;
        }
    }


    public function eliminarBailes(Baile $baileEliminar)
    {
        if (in_array($baileEliminar, $this->listaClases)) {
            $indice = array_search($baileEliminar, $this->listaClases, true);
            unset($this->listaClases[$indice]);
            return true;
        } else {
            return false;
        }
    }

    public function amosarBailes()
    {
        if (empty($this->listaClases)) {
            echo "No hai clases";
            return false;
        }
        foreach ($this->listaClases as $value) {
            echo $value->getNome() . " (idade min: {$value->getIdadeMinima()} anos) </br>";
        }
    }

    public function getNif()
    {
        return $this->nif;
    }
}
