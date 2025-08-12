<?php

namespace App\Enum;

enum StatusCobrancaImediata: string
{
    case ATIVA = 'ATIVA';
    case CONCLUIDA = 'CONCLUIDA';
    case REMOVIDA_PELO_USUARIO_RECEBEDOR = 'REMOVIDA_PELO_USUARIO_RECEBEDOR';
    case REMOVIDA_PELO_PSP = 'REMOVIDA_PELO_PSP';
}