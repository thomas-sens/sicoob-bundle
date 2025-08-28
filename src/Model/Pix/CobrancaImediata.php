<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class CobrancaImediata
{
    public function __construct(
        public Calendario $calendario,
        public Devedor $devedor,
        public Valor $valor,
        public string $chave,
        public ?string $solicitacaoPagador = null,
        /** @var InfoAdicional[]|null */
        public ?array $infoAdicionais = null,
        public ?Loc $loc = null,
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
            'devedor' =>  $this->devedor->toArray(),
            'valor' => $this->valor->toArray(),
            'chave' => $this->chave,
        ];

        if ($this->revisao !== null) {
            $ret['revisao'] = $this->revisao;
        }

        if ($this->location !== null) {
            $ret['location'] = $this->location;
        }

        if ($this->status !== null) {
            $ret['status'] = $this->status;
        }

        if ($this->brcode !== null) {
            $ret['brcode'] = $this->brcode;
        }

        if ($this->solicitacaoPagador !== null) {
            $ret['solicitacaoPagador'] = $this->solicitacaoPagador;
        }

        if ($this->infoAdicionais !== null) {
            $ret['infoAdicionais'] = array_map(
                fn ($info) => $info instanceof InfoAdicional ? $info->toArray() : $info,
                $this->infoAdicionais
            );
        }

        if ($this->txid !== null) {
            $ret['txid'] = $this->txid;
        }

        if ($this->loc !== null) {
            $ret['loc'] = $this->loc->toArray();
        }

        return $ret;
    }

}
