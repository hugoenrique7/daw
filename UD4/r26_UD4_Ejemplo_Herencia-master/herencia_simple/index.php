<?php
//Para que PHP reconozca las clases, es necesario incluir los archivos donde se definen.
//Si no, se produce Fatal error: Uncaught Error: Class "Animal" not found in line x
require_once "Animal.php";
require_once "Perro.php";  
require_once "Gato.php";

echo "<h1>Ejemplo de Herencia en PHP</h1>";

$animal = new Animal("Elefante");
$perro = new Perro("Rex");
$gato = new Gato("Misu");


echo $animal->getNombre() . ": " . $animal->hablar();
echo "<br>";
echo $perro->getNombre() . ": " . $perro->hablar();
echo "<br>";
echo $gato->getNombre() . ": " . $gato->hablar();
