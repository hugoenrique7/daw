<?php 
interface Exportador {
    public function exportar(Recurso $recurso): string;
}