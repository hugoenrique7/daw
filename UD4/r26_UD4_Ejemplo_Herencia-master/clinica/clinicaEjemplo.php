<?php
// Uso
require_once 'Animal.php';
require_once 'Perro.php';
require_once 'Gato.php';
require_once 'Clinica.php';
require_once 'Persona.php';



$dueno1 = new Persona("Uxia Loureiro", "699444999");

$perro1 = new Perro("Rex");
$gato1 = new Gato("Misu");

$perro2 = new Perro("Toby"); //sin dueño

$elefante = new Animal("Dumbo");

$perro1->setDueno($dueno1);
$gato1->setDueno($dueno1);

$elefante->setDueno(new Persona("Reserva Natural Africana", "+27800123456"));



$clinica = new Clinica("Clínica Veterinaria");
$clinica->agregarAnimal($perro1);
$clinica->agregarAnimal($gato1);
$clinica->agregarAnimal($perro2);
$clinica->agregarAnimal($elefante);

$clinica->listarAnimales();


$clinica->contarPorTipo();