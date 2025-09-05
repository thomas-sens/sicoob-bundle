<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

use DateTimeImmutable;

readonly class Pix
{
    public function __construct(
        public string $endToEndId,         // ^[a-zA-Z0-9]{32}$
        public ?string $txid,              // [a-zA-Z0-9]{1,35}
        public string $valor,              // ^\d{1,10}\.\d{2}$
        public ?string $chave,             // até 77
        public DateTimeImmutable $horario, // $date-time
        public ?string $infoPagador,       // até 140
        /** @var Devolucao[] */
        public array $devolucoes = []
    ) {
        // Validações básicas (pode trocar por Assert/Validator do Symfony se preferir)
        if (!preg_match('/^[a-zA-Z0-9]{32}$/', $endToEndId)) {
            throw new \InvalidArgumentException("endToEndId inválido");
        }

        if ($txid !== null && !preg_match('/^[a-zA-Z0-9]{1,35}$/', $txid)) {
            throw new \InvalidArgumentException("txid inválido");
        }

        if (!preg_match('/^\d{1,10}\.\d{2}$/', $valor)) {
            throw new \InvalidArgumentException("valor inválido");
        }
    }
}