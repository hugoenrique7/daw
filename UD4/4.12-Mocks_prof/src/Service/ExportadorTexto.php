<?php 
namespace App\Service;
use App\Model\Biblioteca\Recurso;

class ExportadorTexto implements Exportador {
    public function exportar(Recurso $recurso): string {
        return $recurso->getDescripcion();
    }
}