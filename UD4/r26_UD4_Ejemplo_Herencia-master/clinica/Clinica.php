<?php
class Clinica {

    private string $nombre;
    private array $animales = []; // array de objetos Animal

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    // Añadir un animal
    public function agregarAnimal(Animal $animal): void {
        $this->animales[] = $animal;
    }

    // Mostrar información de todos los animales
    public function listarAnimales(): void {
        echo "<h3>Animales en {$this->nombre}</h3>";
        foreach ($this->animales as $animal) {
               echo $animal->verInformacion() . "<br>";
        }
    }

    // Contar cuántos animales hay de cada tipo
    public function contarPorTipo(): void {
        $conteo = [];
        foreach ($this->animales as $animal) {
            //get_class devuelve el nombre de la clase del objeto
            //https://www.php.net/manual/es/function.get-class.php
            $tipo = get_class($animal);
            if (!isset($conteo[$tipo])) {
                $conteo[$tipo] = 0;
            }
            $conteo[$tipo]++;
        }

        echo "<h4>Conteo por tipo:</h4>";
        foreach ($conteo as $tipo => $cantidad) {
            echo "$tipo: $cantidad<br>";
        }
    }
}


