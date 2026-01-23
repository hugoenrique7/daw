<?php

class  Academia
{

    const NOME = "CHAN DO MONTE";
    public $profesores = [];
    public $alumnos = [];


    public function addProfesor(Profesores $profesores)
    {
        return $this->profesores[] = $profesores;
    }


    public function addAlumno(Alumno $aluno)
    {
        return $this->alumnos[] = $aluno;
    }



    public function mostrasTodo()
    {
        echo "Academia: " . self::NOME . "<br>";
        if (!empty($this->profesores)) {
            foreach ($this->profesores as $prof) {


                $prof->amosarBailes();
            }
        } else {

            echo "No hai profesores de alta";
        }


        if (!empty($this->alumnos)) {
            echo "------Alumnos---------<br>";
            if (!empty($this->alumnos)) {
                foreach ($this->alumnos as $alumn) {
                    echo $alumn->verInformacion();
                }
            }
        } else {
            echo "no Hai alumnos matriculados";
        }
    }
}
