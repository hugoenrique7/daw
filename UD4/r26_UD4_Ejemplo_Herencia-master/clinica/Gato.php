
<?php
class Gato extends Animal {

    public function hablar(): string {
        //hace uso del método hablar() de la clase madre y al resultado, le concatena un texto propio
        return parent::hablar() 
            . " En concreto, el gato maúlla.";
    }
}
?>

