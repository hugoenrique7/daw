<?php
namespace App\Service;
use App\Model\Biblioteca\Recurso;

interface Exportador {
    public function exportar(Recurso $recurso): string;
}