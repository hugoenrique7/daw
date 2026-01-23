<?php
require_once "Persoa.php";
require_once "Profesores.php";

$prof1 = new Profesores("Victor", "Viado", 722589874, "04681784Q");
echo $prof1->verInformacion();
