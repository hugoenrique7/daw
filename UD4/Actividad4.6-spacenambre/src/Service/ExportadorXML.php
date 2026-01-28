<?php 
class ExportadorXML implements Exportador {

    public function exportar(Recurso $recurso): string {
        $tipo = htmlspecialchars($recurso->getTipo());
        $titulo = htmlspecialchars($recurso->getTitulo());

        // XML simple como string
        return "<recurso>
    <tipo>{$tipo}</tipo>
    <titulo>{$titulo}</titulo>
</recurso>";
    }
}