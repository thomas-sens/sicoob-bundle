<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class InfoAdicional
{
    public function __construct(
        public string $nome,
        public string $valor
    ) {}
    
    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'valor' => $this->valor,
        ];
    }
}
