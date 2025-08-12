<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Calendario
{
    public function __construct(
        public ?int $expiracao = null,   // segundos até expirar
        public ?string $criacao = null // ex: data/hora de criação
    ) {}

    public function toArray(): array
    {
        return [
            'expiracao' => $this->expiracao, 
            'criacao' => $this->criacao
        ];
    }
}
