<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Violacao implements \JsonSerializable
{
    public function __construct(
        private string $razao,
        private string $propriedade,
        private mixed $valor
    ) {}

    public function getRazao(): string
    {
        return $this->razao;
    }

    public function getPropriedade(): string
    {
        return $this->propriedade;
    }

    public function getValor(): mixed
    {
        return $this->valor;
    }

    public function toArray(): array
    {
        return [
            'razao' => $this->razao,
            'propriedade' => $this->propriedade,
            'valor' => $this->valor,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['razao'] ?? '',
            $data['propriedade'] ?? '',
            $data['valor'] ?? null
        );
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
