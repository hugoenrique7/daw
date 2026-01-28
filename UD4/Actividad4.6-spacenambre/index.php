<?php

require_once 'src/Service/Traits/Logger.php';
require_once 'src/Model/Biblioteca/Recurso.php';
require_once 'src/Model/Infraestructura/Recurso.php';


require_once 'src/Model/Biblioteca/Libro.php';
require_once 'src/Model/Biblioteca/Revista.php';
require_once 'src/Model/Biblioteca/Video.php';

require_once 'src/Service/Exportador.php';
require_once 'src/Service/ExportadorTexto.php';
require_once 'src/Service/ExportadorJSON.php';
require_once 'src/Service/ExportadorXML.php';


use App\Service\Traits\Logger;
use App\Service\Exportador;
use App\Service\ExportadorTexto;
use App\Service\ExportadorJSON;
use App\Service\ExportadorXML;
use App\Model\Biblioteca\Recurso;
use App\Model\Infraestructura\Recurso as RecursoInfra;
use App\Model\Biblioteca\Libro;
use App\Model\Biblioteca\Revista;
use App\Model\Biblioteca\Video;


$libro = new Libro("Aprendiendo PHP", "978-3-16-148410-0");
echo $libro->getDescripcion();


$revista = new Revista("Tech Monthly", 42);
$video = new Video("Curso de PHP", 120);

echo $libro->getDescripcion();
echo "<br/>";
echo $revista->getDescripcion();
echo "<br/>";
echo $video->getDescripcion();

echo "<h2> Exportación</h2>";
$video->setExportador(new ExportadorTexto());
echo $video->exportar();
echo "<br/>";
$video->setExportador(new ExportadorJSON());
echo "<pre>";
echo $video->exportar();
echo "</pre>";
echo "<br/>";
$video->setExportador(new ExportadorXML());
echo "<pre>";
echo htmlspecialchars($video->exportar());
echo "</pre>";

$video->agregarRecurso(new RecursoInfra("Video En VHS"));
$video->agregarRecurso(new RecursoInfra("Video En DVD"));
foreach ($video->getRecursos() as $value) {
    echo $value->getDescripcion()."<br>";
}