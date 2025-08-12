<?php

namespace App\Enum;

enum TipoCobranca: string
{
    case PIX = 'PIX';
    case BOLETO = 'BOLETO';
}