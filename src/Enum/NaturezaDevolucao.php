<?php

namespace ThomasSens\SicoobBundle\Enum;

enum NaturezaDevolucao: string
{
    case ORIGINAL = 'ORIGINAL';
    case RETIRADA = 'RETIRADA';
    case MED_OPERACIONAL = 'MED_OPERACIONAL';
    case MED_FRAUDE = 'MED_FRAUDE';
}