<?php

namespace ThomasSens\SicoobBundle\Enum;

enum StatusDevolucao: string
{
    case EM_PROCESSAMENTO = 'EM_PROCESSAMENTO';
    case DEVOLVIDO = 'DEVOLVIDO';
    case NAO_REALIZADO = 'NAO_REALIZADO';
}