<?php
require_once __DIR__.DIRECTORY_SEPARATOR."autoload.php";
use App\Model\Biblioteca\{  Libro, Revista, Video};
use App\Service\{  ExportadorTexto, ExportadorJSON, ExportadorXML };


// require_once "src/Service/Traits/Logger.php";
// require_once 'src/Service/Exportador/Exportador.php';
// require_once 'src/Service/Exportador/ExportadorTexto.php';
// require_once 'src/Service/Exportador/ExportadorJSON.php';
// require_once 'src/Service/Exportador/ExportadorXML.php';
// require_once 'src/Model/Infraestructura/Recurso.php';
// require_once 'src/Model/Biblioteca/Recurso.php';
// require_once 'src/Model/Biblioteca/Libro.php';
// require_once 'src/Model/Biblioteca/Revista.php';
// require_once 'src/Model/Biblioteca/Video.php';




$libro = new Libro("Aprendiendo PHP", "978-3-16-148410-0");
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