<?php
require_once "Persoa.php";
require_once "Alumno.php";
require_once "Baile.php";
require_once "Profesores.php";
require_once "Academia.php";

$tango = new Baile("TANGO", 10);
$afro = new Baile("AFRO");
$samba = new Baile("SAMBA");
$samba20 = new Baile("SAMBA", 20);
$sambaNOeliminar = new Baile("SAMBAeliminar", 20);


$prof1 = new Profesores("Victor", "Viado", 722589874, "04681784Q");

$prof1->engadirBailes($tango);
$prof1->engadirBailes($afro);
$prof1->engadirBailes($samba);
$prof1->engadirBailes($samba);



echo $prof1->verInformacion();
echo Profesores::calcularSoldo(10);
$prof1->amosarBailes();

echo "---------------------";
$alumno_uno = new Alumno("hugo", "Enrique", 24242424, 4);
$alumno_dos = new Alumno("david", "coa", 588857788, 2);

echo $alumno_uno->aPagar();
echo $alumno_dos->aPagar();


$academia = new Academia();
$academia->addProfesor($prof1);
$academia->addAlumno($alumno_uno);
$academia->addAlumno($alumno_dos);

echo ($prof1->eliminarBailes($samba)) ? "<br>Eliminado correctamente" : "<br>Error no fue posible eliminar baile " ;
echo ($prof1->eliminarBailes($sambaNOeliminar)) ? "<br>Eliminado correctamente" : "<br>Error no fue posible eliminar " ;
$prof1->amosarBailes();
$academia->mostrasTodo();
