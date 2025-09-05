<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

use ThomasSens\SicoobBundle\Enum\NaturezaDevolucao;
use ThomasSens\SicoobBundle\Enum\StatusDevolucao;

readonly class Devolucao
{
    public function __construct(
        public string $id,                     // ^[a-zA-Z0-9]{1,35}$
        public string $rtrId,                  // [a-zA-Z0-9]{32}
        public string $valor,                  // ^\d{1,10}\.\d{2}$
        public ?NaturezaDevolucao $natureza,   // Enum
        public ?string $descricao,             // até 140
        public DevolucaoHorario $horario,
        public StatusDevolucao $status,
        public ?string $motivo = null          // até 140
    ) {
        if (!preg_match('/^[a-zA-Z0-9]{1,35}$/', $id)) {
            throw new \InvalidArgumentException("id inválido");
        }

        if (!preg_match('/^[a-zA-Z0-9]{32}$/', $rtrId)) {
            throw new \InvalidArgumentException("rtrId inválido");
        }

        if (!preg_match('/^\d{1,10}\.\d{2}$/', $valor)) {
            throw new \InvalidArgumentException("valor inválido");
        }
    }
}