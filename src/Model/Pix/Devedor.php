<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Devedor 
{

    public function __construct(
        public ?string $cpf = null,
        public ?string $cnpj = null,
        public ?string $nome = null
    ) {}

    public function getNome(): string
    {
        return $this->nome;
    }

    public function toArray(): array
    {
        if ($this->cpf!==null) {
            return [
                'cpf' => str_replace(['.', '/','-'], '', $this->cpf),
                'nome' => $this->nome,
            ];
        } else {
            return [
                'cnpj' => str_replace(['.', '/','-'], '', $this->cnpj),
                'nome' => $this->nome,
            ];
        }

    }
}