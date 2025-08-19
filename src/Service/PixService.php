<?php

namespace ThomasSens\SicoobBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use ThomasSens\SicoobBundle\Model\Pix\CobrancaImediata;
use ThomasSens\SicoobBundle\Model\Pix\Problema;
use ThomasSens\SicoobBundle\Model\Pix\Webhook;

class PixService {

    private string $apiUrlRecebimentos;
    private string $apiUrlPagamentos;

    public function __construct(
        private RequestService $requestService,
        private ParameterBagInterface $params
    ) {
        $env = $this->params->get("sicoob.environment");
        $this->apiUrlRecebimentos = $this->params->get("sicoob.environments.$env.pix_recebimentos");
        $this->apiUrlPagamentos = $this->params->get("sicoob.environments.$env.pix_pagamentos");
    }

    public function criarCobranca(CobrancaImediata $cobrancaImediata): CobrancaImediata|Problema {
        $url = $this->apiUrlRecebimentos . "/cob";
        return $this->requestService->makeRequestObject('POST', $url, $cobrancaImediata->toArray(), CobrancaImediata::class);
    }

    public function consultarCobranca(string $txid, int $revisao): CobrancaImediata|Problema {
        $url = $this->apiUrlRecebimentos . "/cob/$txid?revisao=$revisao";
        return $this->requestService->makeRequestObject('GET', $url, null, CobrancaImediata::class);
    }

    public function criarWebhookPagamentos(Webhook $webhook): CobrancaImediata|Problema {
        $url = $this->apiUrlPagamentos . "/pagamentos/webhook";
        return $this->requestService->makeRequestObject('PUT', $url, $webhook->toArray(), null);
    }

    public function criarWebhookRecebimentos(Webhook $webhook, string $chave): ?Problema
    {
        $url = $this->apiUrlRecebimentos . "/webhook/$chave";
        return $this->requestService->makeRequestObject('PUT', $url, $webhook->toArray(), null);
    }
}
