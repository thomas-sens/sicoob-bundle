<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class CobrancaImediata
{
    public function __construct(
        public Calendario $calendario,
        public ?string $txid,
        public ?int $revisao,
        public ?Devedor $devedor = null,
        public ?Loc $loc = null,
        public ?string $location = null,
        public ?string $status,
        public Valor $valor,
        public ?string $brcode = null,
        public string $chave,
        public ?string $solicitacaoPagador = null,
        /** @var InfoAdicional[]|null */
        public ?array $infoAdicionais = null
    ) {}
    

    public function toArray(): array
    {
        return [
            'calendario' => $this->calendario->toArray(),
            'txid' => $this->txid,
            'revisao' => $this->revisao,
            'devedor' => $this->devedor?->toArray(),
            'loc' => $this->loc?->toArray(),
            'location' => $this->location,
            'status' => $this->status,
            'valor' => $this->valor->toArray(),
            'brcode' => $this->brcode,
            'chave' => $this->chave,
            'solicitacaoPagador' => $this->solicitacaoPagador,
            'infoAdicionais' => $this->infoAdicionais
                ? array_map(fn ($info) => $info instanceof InfoAdicional ? $info->toArray() : $info, $this->infoAdicionais)
                : null,
        ];
    }

}
