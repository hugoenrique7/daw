<?php 
namespace App\Service;
use App\Model\Biblioteca\Recurso;

class ExportadorJSON implements Exportador {
    public function exportar(Recurso $recurso): string {
        return json_encode([
            "tipo" => $recurso->getTipo(),
            "titulo" => $recurso->getTitulo()
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}