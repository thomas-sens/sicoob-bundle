<?php

namespace ThomasSens\SicoobBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use ThomasSens\SicoobBundle\Model\Pix\CobrancaImediata;

class PixService {

    private $api_url;

    public function __construct(
        private RequestService $requestService,
        private ParameterBagInterface $parameter
    ) {
        $this->api_url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/pix/api/v2';
    }

    public function criarCobranca(CobrancaImediata $cobrancaImediata): ?CobrancaImediata {
        $url = $this->api_url . "/cob";
        return $this->requestService->makeRequest('POST', $url, $cobrancaImediata->toArray(), CobrancaImediata::class);
    }

    public function consultarCobranca(string $txid, int $revisao): ?CobrancaImediata {
        $url = $this->api_url . "/cob/$txid?revisao=$revisao";
        return $this->requestService->makeRequest('GET', $url, null, CobrancaImediata::class);
    }

}