<?php
namespace ThomasSens\SicoobBundle\Factory;

use ThomasSens\SicoobBundle\Model\Pix\Pix;
use ThomasSens\SicoobBundle\Model\Pix\Devolucao;
use ThomasSens\SicoobBundle\Model\Pix\DevolucaoHorario;
use ThomasSens\SicoobBundle\Enum\NaturezaDevolucao;
use ThomasSens\SicoobBundle\Enum\StatusDevolucao;

class PixFactory
{
    /**
     * @param array $retorno
     * @return Pix[]
     */
    public static function converteRequestParaPix(array $retorno): array
    {
        $pixList = [];

        if (!isset($retorno['pix']) || !is_array($retorno['pix'])) {
            return $pixList;
        }

        foreach ($retorno['pix'] as $pixData) {
            $devolucoes = [];
            if (!empty($pixData['devolucoes'])) {
                $devs = $pixData['devolucoes'];
                // normaliza para array
                if (isset($devs['id'])) {
                    $devs = [$devs];
                }
                foreach ($devs as $dev) {
                    $devolucoes[] = new Devolucao(
                        id: $dev['id'],
                        rtrId: $dev['rtrId'],
                        valor: $dev['valor'],
                        natureza: isset($dev['natureza']) ? NaturezaDevolucao::from($dev['natureza']) : null,
                        descricao: $dev['descricao'] ?? null,
                        horario: new DevolucaoHorario(
                            solicitacao: new \DateTimeImmutable($dev['horario']['solicitacao']),
                            liquidacao: isset($dev['horario']['liquidacao']) ? new \DateTimeImmutable($dev['horario']['liquidacao']) : null
                        ),
                        status: StatusDevolucao::from($dev['status']),
                        motivo: $dev['motivo'] ?? null
                    );
                }
            }

            $pixList[] = new Pix(
                endToEndId: $pixData['endToEndId'],
                txid: $pixData['txid'] ?? null,
                valor: $pixData['valor'],
                chave: $pixData['chave'] ?? null,
                horario: new \DateTimeImmutable($pixData['horario']),
                infoPagador: $pixData['infoPagador'] ?? null,
                devolucoes: $devolucoes
            );
        }

        return $pixList;
    }
}
