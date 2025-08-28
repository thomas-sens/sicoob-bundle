<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Calendario
{
    public function __construct(
        public ?int $expiracao = null, // segundos até expirar
        public ?string $criacao = null // ex: data/hora de criação
    ) {}

    public function toArray(): array
    {
        return [
            'expiracao' => $this->expiracao, 
            'criacao' => $this->criacao
        ];
    }

    public function getDataVencimento(): \DateTime
    {
        if ($this->criacao === null) {
            throw new \InvalidArgumentException("Data de criação não informada no calendário.");
        }

        // cria DateTime a partir da string
        $dataCriacao = new \DateTime($this->criacao);

        // soma a expiração em segundos (se houver)
        $vencimento = $this->expiracao !== null
            ? $dataCriacao->add(new \DateInterval('PT' . $this->expiracao . 'S'))
            : $dataCriacao;

        return $vencimento;
    }
}
