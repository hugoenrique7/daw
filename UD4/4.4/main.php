<?php
require_once "Exportable.php";
require_once "Recurso.php";
require_once "Libro.php";
require_once "Revista.php";
require_once "Video.php";



$libro = new Libro("Vendo Levou", "ADS123");
$revista = new Revista("Caras", 15);
$video = new Video("titanic", 200);


echo $libro->getTipo() . "<br>";
echo $libro->getDescripcion() . "<br>";

echo $revista->getTipo() . "<br>";
echo $revista->getDescripcion() . "<br>";


echo $video->getTipo() . "<br>";
echo $video->getDescripcion() . "<br>";


echo $video->exportar();
echo $revista->exportar();
  //El resultado será: