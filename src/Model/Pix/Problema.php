<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

/**
 * Representa um problema conforme RFC 7807 (Problem Details for HTTP APIs),
 * com extensões usadas pelo Pix (Banco Central / Sicoob).
 */
class Problema implements \JsonSerializable
{
    /**
     * @param Violacao[] $violacoes
     */
    public function __construct(
        private string $type,
        private string $title,
        private int $status,
        private ?string $detail = null,
        private ?string $correlationId = null,
        private array $violacoes = []
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function getCorrelationId(): ?string
    {
        return $this->correlationId;
    }

    /**
     * @return Violacao[]
     */
    public function getViolacoes(): array
    {
        return $this->violacoes;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'title' => $this->title,
            'status' => $this->status,
            'detail' => $this->detail,
            'correlationId' => $this->correlationId,
            'violacoes' => array_map(fn(Violacao $v) => $v->toArray(), $this->violacoes),
        ];
    }

    public static function fromArray(array $data): self
    {
        $violacoes = [];
        if (!empty($data['violacoes']) && is_array($data['violacoes'])) {
            foreach ($data['violacoes'] as $v) {
                $violacoes[] = Violacao::fromArray($v);
            }
        }

        return new self(
            $data['type'] ?? '',
            $data['title'] ?? '',
            $data['status'] ?? 0,
            $data['detail'] ?? null,
            $data['correlationId'] ?? null,
            $violacoes
        );
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
