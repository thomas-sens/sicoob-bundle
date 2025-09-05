<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

use DateTimeImmutable;

readonly class DevolucaoHorario
{
    public function __construct(
        public DateTimeImmutable $solicitacao,
        public ?DateTimeImmutable $liquidacao = null
    ) {}
}