<?php
class ExportadorJSON implements Exportador {
    public function exportar(Recurso $recurso): string {
        return json_encode([
            "tipo" => $recurso->getTipo(),
            "titulo" => $recurso->getTitulo()
        ]);
    }
}