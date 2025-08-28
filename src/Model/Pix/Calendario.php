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

        $dataCriacao = new \DateTime($this->criacao, new \DateTimeZone('UTC'));

        // soma a expiração em segundos (se houver)
        $vencimento = $this->expiracao !== null
            ? $dataCriacao->add(new \DateInterval('PT' . $this->expiracao . 'S'))
            : $dataCriacao;

        $vencimento->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
        
        return $vencimento;
    }

    public function getCriacao(): \DateTime
    {

        $dataCriacao = new \DateTime($this->criacao, new \DateTimeZone('UTC'));

        $dataCriacao->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
        
        return $dataCriacao;
    }
}
