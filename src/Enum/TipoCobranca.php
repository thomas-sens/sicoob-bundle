<?php

namespace ThomasSens\SicoobBundle\Enum;

enum TipoCobranca: string
{
    case PIX = 'PIX';
    case BOLETO = 'BOLETO';
}