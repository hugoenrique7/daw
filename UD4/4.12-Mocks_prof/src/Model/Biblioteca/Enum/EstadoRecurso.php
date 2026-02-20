<?php

namespace App\Model\Biblioteca\Enum;

enum EstadoRecurso: string {
    case DISPONIBLE = 'disponible';
    case PRESTADO = 'prestado';
    case RESERVADO = 'reservado';
}