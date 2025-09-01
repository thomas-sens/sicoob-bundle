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

    public function consultarCobranca(string $txid): CobrancaImediata|Problema {
        $url = $this->apiUrlRecebimentos . "/cob/$txid";
        return $this->requestService->makeRequestObject('GET', $url, null, CobrancaImediata::class);
    }

    public function consultarListaCobranca(): Problema|array {
        $agora = new \DateTimeImmutable('now', new \DateTimeZone('UTC')); 
        $inicio = $agora->sub(new \DateInterval('P7D')); // últimos 30 dias

        $inicioStr = $inicio->format('Y-m-d\TH:i:s\Z'); // ex: 2025-07-28T00:00:00Z
        $fimStr    = $agora->format('Y-m-d\TH:i:s\Z');  // ex: 2025-08-27T17:43:00Z
        
        $url = sprintf(
            "%s/cob?inicio=%s&fim=%s",
            $this->apiUrlRecebimentos,
            $inicioStr,
            $fimStr
        );

        return $this->requestService->makeRequestObject('GET', $url, null, CobrancaImediata::class, true);
    }

    public function consultarWebhooks(): array {
        $agora = new \DateTimeImmutable('now', new \DateTimeZone('UTC')); 
        $url = sprintf(
            "%s/webhook",
            $this->apiUrlRecebimentos
        );
        return $this->requestService->makeRequest('GET', $url);
    }

    public function criarWebhookPagamentos(Webhook $webhook): CobrancaImediata|Problema {
        $url = $this->apiUrlPagamentos . "/pagamentos/webhook";
        return $this->requestService->makeRequestObject('PUT', $url, $webhook->toArray(), null);
    }

    public function criarWebhookRecebimentos(Webhook $webhook, string $chave): Problema|array
    {
        $url = $this->apiUrlRecebimentos . "/webhook/$chave";
        return $this->requestService->makeRequestObject('PUT', $url, $webhook->toArray(), null);
    }

    public function gerarQrcode(string $txid): array {
        $url = $this->apiUrlRecebimentos . "/cob/$txid/imagem";
        return $this->requestService->makeRequest('GET', $url, null);
    }

}
