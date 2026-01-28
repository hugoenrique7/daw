<?php 
class ExportadorTexto implements Exportador {
    public function exportar(Recurso $recurso): string {
        return $recurso->getDescripcion();
    }
}