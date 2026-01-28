<?php
require_once "Logger.php";
require_once 'Exportador.php';
require_once 'ExportadorTexto.php';
require_once 'ExportadorJSON.php';
require_once 'ExportadorXML.php';
require_once 'Recurso.php';
require_once 'Libro.php';
require_once 'Revista.php';
require_once 'Video.php';


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