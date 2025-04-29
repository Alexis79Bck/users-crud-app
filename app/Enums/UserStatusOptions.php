<?php

namespace App\Enums;

enum UserStatusOptions: string
{
    case ACTIVO = "Activo";
    case INACTIVO = "Inactivo";
    case SUSPENDIDO = "Suspendido";
    case BLOQUEADO = "Bloqueado";
    case BANEADO = "Baneado";
}