<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Valor
{
    public function __construct(
        public ?string $original = null // valor no formato "100.50"
    ) {}

    public function toArray(): array
    {
        $formatted = number_format((float) $this->original, 2, '.', '');
        return ['original' => $formatted];
    }
}