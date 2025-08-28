<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class CobrancaImediata
{
    public function __construct(
        public Calendario $calendario,
        public Devedor $devedor,
        public Loc $loc,
        public Valor $valor,
        /** @var InfoAdicional[]|null */
        public array $infoAdicionais,
        public string $chave,
        public string $solicitacaoPagador,
        public ?string $txid = null,
        public ?int $revisao = null,
        public ?string $location = null,
        public ?string $status = null,
        public ?string $brcode = null,
    ) {}

    public function toArray(): array
    {
        $ret = [
            'calendario' => $this->calendario->toArray(),
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
        if ($this->txid) $ret['txid'] = $this->txid;
        return $ret;
    }

}
